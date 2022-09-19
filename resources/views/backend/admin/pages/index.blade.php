@extends('backend.layouts.master')
@section("title","Pages Settings")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/custom-datepicker.css')}}">
    <style>

    </style>
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pages Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Pages Settings</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content" style="margin-top: 50px">
        <div class="row">
            <div class="col-8 offset-2">
                <!-- general form elements -->
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title float-left">Pages Settings</h3>
                        <div class="float-right">
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">
                        <form id="pageSubmit">
                            <label>Terms And Condition <small class="text-info"> </small></label>
                            <div class="input-group">
                                <select name="type" id="type" onchange="getType()" class="form-control" required>
                                    <option value="">Choose One</option>
                                    <option value="terms_and_condition">Terms And Condition</option>
                                    <option value="payments_term">Payments Term</option>
                                    <option value="privacy_policy">Privacy Policy</option>
                                    <option value="faq">Faq</option>
                                    <option value="about_us">About Us</option>
                                    <option value="contact_us">Contact Us</option>
                                </select>
                            </div>
                            <div class="text-center" id="editorText" >
                                <h1 class="text-center text-info p-3"><i class="fa fa-info-circle"></i> Please select page type first.</h1>
                            </div>
                            <div class="text-center" id="editorDiv" style="display: none;">
                                <form action="">
                                    <div class="input-group-appen" style="width: 100%;margin-top: 20px">
                                        <textarea name="value" id="" class="form-control value"></textarea>
                                    </div>
                                    <div class="input-group-append pt-2">
                                        <button type="submit"  class="btn btn-info w-25">Update</button>
                                    </div>
                                </form>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop
@push('js')
    <script src="//cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <script src="{{asset('backend/plugins/ckeditor/ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace( 'value', {
            filebrowserUploadUrl: "{{route('admin.ckeditor.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
        //get value
        function getType() {
            //alert('onchnged')
            var type = $('#type').val();
            if (type !== "") {
                $.post('{{route('admin.pages.editor.show')}}', {
                    _token: '{{ csrf_token() }}',
                    type: type,
                }, function (data) {
                    CKEDITOR.instances.value.setData(data);
                    $('#editorText').hide();
                    $('#editorDiv').show();
                    $(".value").val(data);
                });
            }
        }

        //value post
        //for Terms And Condition
        $("#pageSubmit").submit(function(event){
            event.preventDefault();
            var updateData = CKEDITOR.instances.value.getData();
            var updateValue = $('#type').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{url('/admin/page/data/update')}}",
                type: 'POST',
                data: {"value": updateData, "type": updateValue },
                success: function(data) {
                    if (data == 1){
                        toastr.success('Data Updated Successfully');
                    }else {
                        toastr.error('Something went wrong!!');
                    }
                }
            });
        })


    </script>
@endpush
