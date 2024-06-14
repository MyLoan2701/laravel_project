<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Brand;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function showContactUs(Request $request)
    {
        //Seo
        $meta_desc = "Web demo cửa hàng bán điện thoại";
        $meta_keywords = "contact, liên hệ";
        $meta_title = "Liên hệ | E-Shopper";
        $url_canonical = $request->url();
        //seo
        $type = Brand::where('status_brand', 0)->get();
        return view('pages.contact.contact')
            ->with(compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'type'));
    }

    public function sendContact(Request $request)
    {
        $data = $request->all();
        if (
            $data['name'] == '' || $data['email'] == '' || $data['phone'] == ''
            || $data['subject'] == '' || $data['message'] == ''
        ) {
            Session::put('warning', 'Vui lòng điền đầy đủ thông tin trước khi gửi.');
            return Redirect::to('/contact-us');
        } else {
            $contact = new Contact();
            $contact['name_contact'] = $data['name'];
            $contact['email_contact'] = $data['email'];
            $contact['phone_contact'] = $data['phone'];
            $contact['subject_contact'] = $data['subject'];
            $contact['message_contact'] = $data['message'];
            if (isset($data['id_client'])) {
                $contact['id_client'] = $data['id_client'];
            }
            $contact->save();
            Session::put('message', 'Vấn đề của bạn đã được gửi thành công.');
            return Redirect::to('/contact-us');
        }
    }

    // END FRONTEND

    public function AuthLogin()
    {
        $id = Auth::id();
        if ($id) {
            return Redirect::to('/admin/home');
        } else {
            return Redirect::to('/admin')->send();
        }
    }

    public function showContact(Request $request, $status)
    {
        $this->AuthLogin();
        if ($status == 'waiting') {
            $contact = Contact::where('status_contact', 'Chờ phản hồi')->orderBy('created_at', 'desc')->get();
        }
        if ($status == 'all') {
            $contact = Contact::all();
        }
        $status = $status;
        return view('admins.contact.showContact')->with(compact('contact', 'status'));
    }

    // END BACKEND
}
