<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\TypePost;
use App\Models\Product;

class PostController extends Controller
{
    public function AuthLogin(){
        $id = Auth::id();
        if ($id) {
            return Redirect::to('/admin/home');
        }
        else {
            return Redirect::to('/admin')->send();
        }
    }

    public function showAddPost(){
        $this->AuthLogin();
        $type = TypePost::all();
        $product = Product::all();
        return view('admins.post.addPost')->with(compact('type', 'product'));
    }
    public function showAddTagPost(){
        $this->AuthLogin();
        $typeP = TypePost::all();
        return view('admins.post.addTagPost')->with(compact('typeP'));
    }
    public function addPost(Request $request){
        $this->AuthLogin();
        $this->validate($request, [
            'name_post' => 'required|max:255',]);
        $post = new Post();
        $data = $request->all();

        if ($data['slug_post'] == '') {
            $post->slug_post = $this->link_slug($data['name_post']);
            // $post->slug_post = strtolower(str_replace("?", "", str_replace(" ", "-", trim($data['name_post']))));
        } else {
            $post->slug_post = $this->link_slug($data['slug_post']);
            // $post->slug_post = strtolower(str_replace("?", "", str_replace(" ", "-", trim($data['slug_post']))));
        }

        if (isset($data['img_post'])) {
            $get_img_name = $data['img_post']->getClientOriginalName();
            $name_img = current(explode('.', $get_img_name));
            $new_img = $name_img . rand(0, 99) . '.' . $data['img_post']->getClientOriginalExtension();
            $data['img_post']->move('public/upload/post', $new_img);
            $post['avatar_post'] = $new_img;
        } else {
            $post['avatar_post'] = '';
        }

        if ($data['author_post'] == '') {
            $post->author_post = Auth::user()->name_admin;
        } else {
            $post->author_post = $data['author_post'];
        }
        $post->poster_post = Auth::user()->name_admin;
        $post->name_post = $data['name_post'];
        $post->content_post = $data['content_post'];
        $post->status_post = $data['status_post'];
        $post->tag_post = $data['tag_post'];
        $post->link_product_post = $data['link_post'];

        $post->save();
        Session::put('message', 'Thêm bài viết mới thành công.');
        return Redirect::to('/admin/show-add-post');
    }
    public function addTagPost(Request $request){
        $this->AuthLogin();
        $this->validate($request, [
            'name_typePost' => 'required|max:255',]);
        $post = new TypePost();
        $data = $request->all();
        foreach(TypePost::all() as $t) {
            if ($t->name_typePost == $data['name_typePost']) {
                Session::put('warning', 'Mục bài viết đã tồn tại.');
                return Redirect::to('/admin/show-add-tag-post');
                break;
            }
        }
        if ($data['slug_typePost'] == '') {
            $post->slug_typePost = strtolower(str_replace(" ", "-", trim($data['name_typePost'])));
        } else {
            $post->slug_typePost = strtolower(str_replace(" ", "-", trim($data['slug_typePost'])));
        }
        $post->name_typePost = $data['name_typePost'];
        $post->description_typePost = $data['description_typePost'];
        $post->status_typePost = $data['status_typePost'];

        $post->save();
        Session::put('message', 'Thêm Mục bài viết mới thành công.');
        return Redirect::to('/admin/show-add-tag-post');
    }
    public function showAllPost(){
        $this->AuthLogin();
        $post = Post::with('type')->get();
        return view('admins.post.allPost')->with(compact('post'));
    }
    public function showDetailPost(Request $request, $id){
        $this->AuthLogin();
        $post = Post::find($id);
        return view('admins.post.detailPost')->with(compact('post'));
    }
    public function showEditPost(Request $request, $id){
        $this->AuthLogin();
        $post = Post::find($id);
        $type = TypePost::all();
        return view('admins.post.updatePost')->with(compact('post', 'type'));
    }
    public function showEditTagPost(Request $request, $id){
        $this->AuthLogin();
        $post = TypePost::find($id);
        return view('admins.post.updateTagPost')->with(compact('post'));
    }
    public function showPreviewPost($id){
        $this->AuthLogin();
        $post = Post::find($id);
        return view('admins.post.previewPost')->with(compact('post'));
    }
    public function upload(Request $request) {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $request->file('upload')->move('public/upload/img', $fileName);
            $url = asset('public/upload/img/'.$fileName);
            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }
    public function updatePost(Request $request, $id) {
        $this->AuthLogin();
        $post = Post::find($id);
        $data = $request->all();
        
        if (isset($data['name_post'])) {
            $post->name_post = $data['name_post'];
        }
        if (isset($data['slug_post'])) {
            $str = str_replace("-", " ", $data['slug_post']);
            $post->slug_post = $this->link_slug($str);
        }
        if (isset($data['content_post'])) {
            $post->content_post = $data['content_post'];
        }
        if (isset($data['author_post'])) {
            $post->author_post = $data['author_post'];
        }
        if (isset($data['img_post'])) {
            $get_img_name = $data['img_post']->getClientOriginalName();
            $name_img = current(explode('.', $get_img_name));
            $new_img = $name_img . rand(0, 99) . '.' . $data['img_post']->getClientOriginalExtension();
            $data['img_post']->move('public/upload/post', $new_img);
            $post['avatar_post'] = $new_img;
        }
        
        $post->status_post = $data['status_post'];
        $post->tag_post = $data['tag_post'];
        $post->poster_post = Auth::user()->name_admin;
        
        $post->save();
        Session::put('message', 'Chỉnh sửa bài viết thành công.');
        return Redirect::to('/admin/show-edit-post/'.$id);
    }
    public function updateTagPost(Request $request, $id) {
        $this->AuthLogin();
        $post = TypePost::find($id);
        $data = $request->all();
        
        if (isset($data['name_typePost'])) {
            $post->name_typePost = $data['name_typePost'];
        }
        if (isset($data['slug_typePost'])) {
            $str = str_replace("-", " ", $data['slug_typePost']);
            $post->slug_typePost = $this->link_slug($str);
        }
        if (isset($data['description_typePost'])) {
            $post->description_typePost = $data['description_typePost'];
        }
        $post->status_typePost = $data['status_typePost'];
        
        $post->save();
        Session::put('message', 'Chỉnh sửa mục bài viết thành công.');
        return Redirect::to('/admin/show-edit-tag-post/'.$id);
    }
    public function delTagPost($id) {
        TypePost::find($id)->delete();
        Session::put('message', 'Xóa Mục bài viết thành công.');
        return Redirect::to('/admin/show-add-tag-post');
    }
    public function delPost($id) {
        Post::find($id)->delete();
        Session::put('message', 'Xóa Bài viết thành công.');
        return Redirect::to('/admin/show-all-post');
    }
    //=====END FUNCTION ADMIN PAGE=====

    public function post(Request $request)
    {
        //Seo
        $meta_desc = "Web demo cửa hàng bán điện thoại - Tin tức ";
        $meta_keywords = "Tin tức, post";
        $meta_title = "Tin tức | E-Shopper";
        $url_canonical = $request->url();
        //seo
        $type = Brand::where('status_brand', 0)->get();
        $typeP = TypePost::all();
        $post = Post::where('status_post', 0)->orderBy('created_at', 'desc')->get();
        return view('pages.post.post')->with(compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 
        'typeP', 'post', 'type'));
    }

    public function typePost(Request $request, $slug)
    {
        $type = Brand::where('status_brand', 0)->get();
        $typeP = TypePost::all();
        $type_current = TypePost::where('slug_typePost', $slug)->first();
        $post = Post::where('status_post', 0)->where('tag_post', $type_current->id_typePost)->orderBy('created_at', 'desc')->get();
        //Seo
        $meta_desc = "Web demo cửa hàng bán điện thoại - Tin tức - ". $type_current->name_typePost;
        $meta_keywords = "Tin tức, post";
        $meta_title = "Tin tức - " .$type_current->name_typePost. " | E-Shopper";
        $url_canonical = $request->url();
        //seo

        $slug_post = $slug;
        return view('pages.post.post')->with(compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 
        'typeP', 'post', 'type', 'slug_post'));
    }

    public function detailPost(Request $request, $slug)
    {
        $type = Brand::where('status_brand', 0)->get();
        $post = Post::where('slug_post', $slug)->with('type')->first();
        
        $post->view_post = $post->view_post + 1;
        $post->save();
        
        if (isset($post->name_post) && $post->name_post != '') {
            //Seo
        $meta_desc = "Web demo cửa hàng bán điện thoại - Tin tức ";
        $meta_keywords = "Tin tức, post";
        $meta_title = $post->name_post . " | E-Shopper";
        $url_canonical = $request->url();
        //seo

        return view('pages.post.detailPost')->with(compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'post', 'type'));
        }
        else return redirect('404');
    }

    //=====END FUNCTION CLIENT PAGE=====
}
