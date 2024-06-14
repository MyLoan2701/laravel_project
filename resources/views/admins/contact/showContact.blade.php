@extends('homeA')
@section('adminContent')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liên hệ từ khách hàng
        </div>
        <?php

        use Illuminate\Support\Facades\Session;

        $mess = Session::get('message');
        if ($mess) {
            echo '<div class="alert-t alert-success" style="margin-top:10px;">' . $mess . '</div>';
            Session::put('message', null);
        }
        ?>
        <div class="status-order" style="margin: 20px 1em;">
            <a href="{{URL::to('/admin/show-contact/waiting')}}" class="<?php echo $retVal = ($status == 'waiting') ? 'active' : 'b'; ?> waiting">Chờ phản hồi</a>
            <a href="{{URL::to('/admin/show-contact/all')}}" class="<?php echo $retVal = ($status == 'all') ? 'active' : 'b'; ?> all">Tất cả</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light" id="tableContact">
                <thead>
                    <tr>
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>Mã</th>
                        <th style="width:350px;">Thông tin</th>
                        <th>Tiêu đề</th>
                        <th>Nội dung</th>
                        <th style="width:230px;">Trạng thái</th>
                        @hasrole(['Admin', 'Author'])
                        <th style="width:30px;">Xóa</th>
                        @endhasrole
                    </tr>
                </thead>
                <tbody>
                    @foreach($contact as $ct)
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                        <td>{{ $ct->id_contact }}</td>

                        <td>
                            <p><b>Tên: </b> {{$ct->name_contact}}</p>
                            <p><b>Email: </b> {{$ct->email_contact}}</p>
                            <p><b>SĐT: </b> {{$ct->phone_contact}}</p>
                            <p><b>Ngày gửi: </b> {{$ct->created_at}}</p>
                        </td>
                        <td>{{ $ct->subject_contact}}</td>
                        <td>{{ $ct->message_contact}}</td>
                        <td class="text-primary">
                            <form action="{{URL::to('/admin/update-contact/'.$ct->id_contact)}}" method="post">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <select class="form-control m-bot15" name="status_contact">
                                        @if ($ct->status_contact == 0)
                                        <option selected value="0">Hiển thị</option>
                                        <option value="1">Chờ phê duyệt</option>
                                        <option value="2">Không được hiển thị</option>
                                        @elseif($ct->status_contact == 1)
                                        <option value="0">Hiển thị</option>
                                        <option selected value="1">Chờ phê duyệt</option>
                                        <option value="2">Không được hiển thị</option>
                                        @elseif($ct->status_contact == 2)
                                        <option value="0">Hiển thị</option>
                                        <option value="1">Chờ phê duyệt</option>
                                        <option selected value="2">Không được hiển thị</option>
                                        @endif
                                    </select>
                                </div>
                                <input type="hidden" name="title_slug" value="{{$status}}" required>
                                <button type="submit" class="btn btn-warning update-status-contact" name="update_status_contact">Sửa</button>
                                <a href="#box_detail_contact" data-toggle="modal" data-id="{{$ct->id_contact}}" class="detail-contact btn btn-primary">Chi tiết</a>;
                            </form>
                        </td>
                        @hasrole(['Admin', 'Author'])
                        <td>
                            <a onclick="return confirm('Bạn muốn XÓA Bình luận này? Hành động này sẽ không được hoàn tác.')" href="{{ URL::to('/admin/del-contact/'.$ct->id_contact) }}">
                                <span class="glyphicon glyphicon-trash icon-trash"></span>
                            </a>
                        </td>
                        @endhasrole
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- #box-detail-contact (Hiện chi tiết bình luận) -->
        <div class="modal fade" id="box_detail_contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Chi tiết Bình Luận</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body-detail-contact">
                            <div class="info-contact">
                                <ul class="list-group" style="margin-bottom: 20px;">
                                    <li class="list-group-item"><b>Người gửi bình luận: </b> <span id="info_name_contact"></span></li>
                                    <li class="list-group-item"><b>Email: </b> <span id="info_email_contact"></span></li>
                                    <li class="list-group-item"><b>Có tài khoản khách: </b> <span id="info_client_contact"></span></li>
                                    <li class="list-group-item"><b>Sản phẩm được bình luận: </b> <span id="info_product_contact"></span></li>
                                    <li class="list-group-item"><b>Trạng thái bình luận: </b> <span id="info_status_contact"></span></li>
                                    <li class="list-group-item"><b>Admin duyệt lần cuối: </b> <span id="info_admin_contact"></span></li>
                                    <li class="list-group-item"><b>Ngày gửi: </b> <span id="info_created_contact"></span></li>
                                </ul>
                            </div>
                            <div>
                                <div id="info_content_contact"></div>
                                <div id="info_rep_contact"></div>
                            </div>
                            <div class="rep-contact" id="info_admin_rep_contact"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- //box-detail-contact -->

    </div>
</div>
@endsection