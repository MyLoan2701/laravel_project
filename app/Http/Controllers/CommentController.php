<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{
    public function waitingComment(Request $request)
    {
        $data = $request->all();
        $comment = new Comment();

        $comment->id_product = $data['id_product'];
        if ($data['id_client'] != '') {
            $comment->id_client = $data['id_client'];
        }
        $comment->name_comment = $data['name'];
        $comment->email_comment = $data['email'];
        $comment->content_comment = $data['content'];

        $comment->save();
    }

    public function AuthLogin()
    {
        //$id = Session::get('id_admin');
        $id = Auth::id();
        if ($id) {
            return Redirect::to('/admin/home');
        } else {
            return Redirect::to('/admin')->send();
        }
    }

    public function showComment($status)
    {
        $this->AuthLogin();
        if ($status == 'waiting') {
            $comment = Comment::where('status_comment', 1)->orderBy('created_at', 'desc')->get();
        }
        if ($status == 'all') {
            $comment = Comment::all();
        }
        $status = $status;
        return view('admins.comment.showComment')->with(compact('comment', 'status'));
    }
    public function updateComment(Request $request, $id)
    {
        $this->AuthLogin();
        $comment = Comment::find($id);
        $comment->status_comment = $request->status_comment;
        $comment->id_admin = Auth::user()->id_admin;
        $comment->save();
        Session::put('message', "Cập nhật bình luận mã (" . $id . ") thành công.");
        return Redirect::to('/admin/show-comment/' . $request->title_slug);
    }
    public function delComment($id)
    {
        $this->AuthLogin();
        $comment = Comment::find($id);
        $comment->delete();
        Session::put('message', "Xóa bình luận mã (" . $id . ") thành công.");
        return Redirect::to('/admin/show-comment/all');
    }

    public function detailComment(Request $request)
    {
        $this->AuthLogin();
        $id = $request->id_comment;
        $comment = Comment::find($id);
        $link_Product = "http://localhost:8080/laravel_project/admin/show-edit-product/";
        $link_admin = "http://localhost:8080/laravel_project/admin/show-edit-admin/";

        $output = [];

        if ($comment->id_client != '') {
            $output['client'] = "Liên kết mã Client - " . $comment->id_client;
        } else {
            $output['client'] = "Không có tài khoản khách liên kết";
        }

        if ($comment->id_admin != '') {
            $output['admin'] = "Mã Admin - " . '<a class="link-admin-connect-comment" href="' . $link_admin . $comment->id_admin . '" target="_blank">' . $comment->id_admin . '</a>';
        } else {
            $output['admin'] = "Chưa được Admin nào phê duyệt";
        }

        if ($comment->status_comment == 0) {
            $output['html_rep'] = '<form style="margin: 15px 15px 0;">
            <div class="form-group">
            <textarea name="rep_comment" id="ipt_admin_rep_comment" class="form-control" style="resize: vertical; height: 100px" ></textarea>
            <button type="button" class="btn btn-info btn-rep-comment" data-id="' . $id . '"
            style="width: 80px; margin: 10px auto;">Trả lời</button>
            <div id="notify_rep_comment"></div>
            </div>
            </form>';
            $output['status'] = 'Hiển Thị';
        } elseif ($comment->status_comment == 1) {
            $output['html_rep'] = '';
            $output['status'] = 'Chờ phê duyệt';
        } elseif ($comment->status_comment == 2) {
            $output['html_rep'] = '';
            $output['status'] = 'Không được hiển thị';
        }

        $output['name'] = $comment->name_comment;
        $output['email'] = $comment->email_comment;
        $output['content'] = $comment->content_comment;
        $output['rep'] = $comment->rep_comment;
        $output['product'] = '<a class="link-product-connect-comment" href="' . $link_Product . $comment->id_product . '" target="_blank">' . $comment->id_product . '</a>';
        $output['created'] = date_format($comment->created_at, "Y/m/d H:i:s");

        echo json_encode($output);
    }

    public function repComment(Request $request)
    {
        $this->AuthLogin();
        $data = $request->all();
        $comment = Comment::find($data['id_comment']);

        $comment->rep_comment = $data['rep'];
        $comment->id_admin = Auth::user()->id_admin;
        $comment->save();

        $output = [
            'notify' => 'Đã trả lởi bình luận.',
            'rep' => $comment->rep_comment,
        ];
    }
}
