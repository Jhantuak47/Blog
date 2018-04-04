@extends('layouts.app')
@include('posts.js.main')
@section('content')
    <h1>All Posts</h1><hr>
        @if(count($allPosts)>0)
        <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                     <div class="row">
                     <div class="col-md-3">
                      Welcome to sections
                     </div>
                     <div class="col-md-5">
                         <form action="" method="" autocomplete="on">
                                 {{ csrf_field() }}
                                 <div class="input-group">
                                   <input type="text" name="searchinput" id="searchinput" size="30%" class="" placeholder="Search sections.." list ="users"
                                   style="background-color : #d1d1d1;"> <span class="input-group-btn"></span>
                                   <datalist id="users">
                                     {{--  @if(!$sections->isEmpty())
                                         @foreach ($sections as $sec)
                                           <option value={{$sec->name}}></option>
                                         @endforeach
                                     @endif --}}
                                     </datalist>
                                   <div class="clearfix"></div>
                                   <button class="btn btn-success" type="submit" style="display:;" onclick="searchSection(event)" id="search_icon">
                                       <span class="glyphicon glyphicon-search"></span>
                                   </button>
                                   <button style="display:none ;font-size:20px; margin-top: 1px;" id="filter_button" class="btn-danger" onclick="removeFilter(event);"><i class="fa fa-remove"></i></button>
                                 </div> 
                         </form>
                     </div>
                     <div class="col-md-3" style="">
                     <button style="margin-left:60px;display:none;font-size:16px;" id="delete-row" class="btn-danger" onclick="delete_modal();"><i class='fa fa-trash-o'></i>&nbsp;Delete</button><!--delete button -->
                     <a onclick = "add();" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add</a>
                     </div>
                    </div><!--row end -->
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    @foreach($allPosts as $Post)
                      <div id="{{$Post->id}}">
                        <div class = "well">
                            <div class = "row">
                                <div class = "col-md-2 col-sm-2">
                                    <img width="100" height="100"  src = "/storage/cover_images/{{$Post->cover_image}}">
                                </div>
                                <div class = "col-md-6 col-sm-6">
                                    <h3 style="margin-top:2px;">
                                            <a href = "post/{{$Post->id}}">{{$Post->title}}</a> 
                                    </h3>
                                        <small>Written on {{$Post->created_at}} ,by- {{$Post->user->name}}</small>
                                </div>
                                <div class = "col-md-4 col-sm-4">
                                      <button class="btn btn-primary btn-md" id = "view_btn" onclick="view_post({{$Post->id}},{{json_encode($postArray)}})" style="margin: 10px 0px 0px 50px;"> View Post</button>
                                </div>
                            </div>
                        </div>
                      </div>
                    @endforeach
                </div>
            
                    <div class="panel-footer" id="pannel_footer">
                        <div class="text-center" id="pannel_footer_content">
                         <div class="text-center">{!! $allPosts->links(); !!}</div>{{-- <div class="pagination"> --}}</div>
                    </div>       
            </div> {{-- end of primary panel --}}
            </div> <!--end of main column -->
        </div> {{-- end of head row   --}}   
        @else
        @endif
@endsection
<!-- Modal -->
<button type="button" id="modalbtn" class="hidden" data-toggle="modal" data-target="#statusmodal">Open Modal</button>
<div id="statusmodal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content ">
      <div class="modal-body">
        <div class="well">
                    <span id="message"></span>
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <br><br>
                        <img style="width:90%; height:36%" src="" id = "modal_cover_image">
                        <hr>
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <h3 id="post_title"></h3><hr>
                        <p id = "modal_body"></p>
                        <hr>
                        <small id = "author"></small>
                    </div>
                </div>
        </div>
        <input type="hidden" id="id"/>
      </div>
      <div class="modal-footer">
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <form action="" method="post" id = "modify_post">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="delete" />
                    <button class="btn btn-danger btn-lg pull-left" onclick="delete_post(event)" name="" style="display: none;" id="delete_post_btn"><i class='fa fa-trash-o'></i>&nbsp;Delete</button>
                </form>
            </div>
            <div class="col-md-4 col-sm-4">
                <button type="button" style="margin-right:70px;" class="btn btn-default btn-lg" id="dismiss_btn" data-dismiss="modal"><i class="fa fa-window-close"></i>&nbsp;Dismiss</button>

            </div>
            <div class="col-md-4 col-sm-4">
                <a onclick="edit_post(event);" id = "edit_post_btn" class="btn btn-primary btn-lg active" style="margin-left:100px; display:none;" ><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;Edit</a>
            </div>
        </div><!--end footer row -->
      </div>
    </div>
 </div>
</div>
<!--Edit Modal -->
<button type="button" id="edit_modalbtn" class="hidden" data-toggle="modal" data-target="#editmodal">Open Modal</button>
<div id="editmodal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content ">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><i class="fa fa-window-close"></i></button>
          <h3 class="modal-title" id="demoheading">Edit Post</h3>
        </div>
      <div class="modal-body">
        <form action="" method="post" id = "modify_post_edit" enctype="multipart/form-data">
          <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="well">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <br><br>
                        <img style="width:90%; height:36%" src="" id = "modal_cover_image_edit" name = "cover_image">
                        <hr>
                        <input type="file" name="cover_image_edit" id="cover_image_edit">
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <input style="display: none;height:33px;font-size:16pt;" type="text" name="title" id="edit_title"><hr>
                        <p id = "modal_body_edit"></p>
                        <hr>
                        <small id = "author_edit"></small>
                    </div>
                </div>
        </div>
        <input type="hidden" id="edit_post_id" name="hidden_id"/>
        <span style="color: red" id = "blank_err"></span>
      </div>
      <div class="modal-footer">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                    <button class="btn btn-success btn-lg pull-left" onclick="save_changes(event)" name="">Save Changes</button>
                </form>
            </div>
            <div class="col-md-6 col-sm-6">
                <button type="button" class="btn btn-danger btn-lg pull-right" id="nobtn" data-dismiss="modal"><i class="fa fa-window-close"></i>&nbsp;No</button>
            </div>
        </div><!--end footer row -->
      </div>
    </div>
 </div>
</div>