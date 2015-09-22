@extends("crm.dashboard")

@section("container")
    <div class="container-fluid " style="margin-top:100px;margin-left:10px" ng-app="AgreementApp" ng-controller="AgreementController">
        <div class="col-md-12">
            <div class="col-md-8">
                <button class="btn btn-primary" data-toggle="modal" data-target="#addAgreementSection">
                    <i class="fa fa-plus"></i> Add new contract section
                </button>
            </div>
            <div class="panel-heading" class="col-md-4">
                Filter: <input type='text' ng-model="searchText">
            </div>
        </div>

        <div class="col-md-12" style="margin-top:20px;padding:0px">

            <div class="col-md-12">
                <div class="panel panel-info ">
                    <div class="panel-heading">
                        <h3 class="panel-title">Contract Agreement Sections</h3>
                    </div>
                    <table class="table table-bordered" ng-show="agreementSections.length" co>
                        <thead>
                        <tr>
                            <th>Section name</th>
                            <th>Section Description</th>
                            <th>Content</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="agreementSection in agreementSections | filter:searchText">
                            <td class="col-md-3">(( agreementSection.section_name ))</td>
                            <td class="col-md-3">(( agreementSection.section_description ))</td>
                            <td class="col-md-4">(( agreementSection.content| limitTo: 40 ))...</td>
                            <td class="col-md-2">
                                <button class='btn btn-danger btn-sm' ng-click="editingAgreementSection($index, agreementSection)">
                                    <i class='fa  fa-w fa-edit'></i>Edit</button>

                                <button class='btn btn-danger btn-sm' ng-click="removeAgreementSection($index, agreementSection)">
                                    <i class='fa  fa-w fa-remove'></i>Delete</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <div class="modal fade" id="addAgreementSection" data-controls-modal="addAgreementSection"
             data-backdrop="static"
             data-keyboard="false">
            <div class="modal-dialog" id="modal_dialog" style="z-index:9000">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" ng-hide="request.type=='request'" ng-click="closeModal()"><span aria-hidden="true">&times;</span></button>
                        <h5 class="modal-title" id="myModalLabel">Add Section</h5>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(["class"=>"form-horizontal"]) !!}
                        <div class="form-group" ng-class="validation.errorclass">
                            {!!Form::label("section_name","Section name:",["class"=>"col-lg-offset-1 col-lg-2 control-label"])!!}
                            <div class="col-lg-8">
                                {!! Form::text("section_name",null,["ng-model"=>"new_section.section_name", "class"=>"form-control","id"=>"section_name","placeholder"=>"Section name" ]) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!!Form::label("section_description","Section description:",["class"=>"col-lg-offset-1 col-lg-2 control-label"])!!}
                            <div class="col-lg-8">
                                {!! Form::text("section_description",null,["ng-model"=>"new_section.section_description","class"=>"form-control","id"=>"section_name","placeholder"=>"Section description" ]) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!!Form::label("content","Content:",["class"=>"col-lg-offset-1 col-lg-2 control-label"])!!}
                            <div class="col-lg-8">
                                {!! Form::textarea("content",null,["ng-model"=>"new_section.content","rows"=>10, "class"=>"form-control","id"=>"section_name","placeholder"=>"Section description" ]) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-8">
                                <button type="button" class="btn btn-primary col-lg-8" ng-disabled="request.type=='request'" ng-click="addAgreementSection(new_section)">
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" ng-show="request.isActive">
                        <div class="alert alert-dismissible col-lg-offset-2 col-lg-9 text-left"
                             ng-class="request.alert" style="font-size: 15px">
                            <button type="button" class="close" ng-hide="request.type=='request'" ng-click="clearRequest()">×</button>
                            <i class="fa fa-w" ng-class="request.icon"></i>
                            <strong>((request.message))</strong>
                        </div>
                    </div>
                </div>
            </div>
            <div style="display:none">
                <span id="apiUrl">{!! URL::to("/api") !!}</span>
                <span id="token_app">{!! Session::token() !!}</span>
            </div>
        </div>

        <div class="col-md-12" ng-show="isEditing" style="padding-top: 40px;">
            <div class="col-md-3">
                <p>Add any of these keys if you want to add user specific information on the contract.</p>
                <ul class="unstyled-list">
                    <li ng-repeat="variable in variables">
                        <b>(( variable.key ))</b>: (( variable.value ))
                    </li>
                </ul>
            </div>
            <div class="col-md-9">
                <div style="margin-top:20px;padding:0px; width: 912px; margin-left: auto; margin-right: auto;">
                    <h4>Edit content here:</h4>
                    <div class="btn-toolbar" data-role="editor-toolbar" data-target="#editor">
                        <div class="btn-group">
                            <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                            <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
                            <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
                            <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
                        </div>
                        <div class="btn-group">
                            <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>
                            <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>
                        </div>

                        <div class="btn-group">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="fa fa-link"></i></a>
                            <div class="dropdown-menu input-append">
                                <input class="span2" placeholder="URL" type="text" data-edit="createLink"/>
                                <button class="btn" type="button">Add</button>
                            </div>
                            <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="fa fa-unlink"></i></a>
                        </div>
                        <div class="btn-group">
                            <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                            <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
                        </div>
                    </div>
                    <div id="editor" ng-keyup="watchContentChange()" contenteditable="true"></div>
                    <button type="button" class="btn btn-primary pull-right" ng-click="saveCurrentEditing()" style="margin-top: 20px;" >
                        <i class='fa  fa-w fa-edit'></i>Save
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section("extrastyles")
    {!! HTML::style("css/sweetalert.css") !!}
    <style type="text/css">
        .btn-circle {
            width: 30px;
            height: 30px;
            text-align: center;
            padding: 6px 0;
            font-size: 12px;
            line-height: 1.428571429;
            border-radius: 15px;
        }
        .btn-circle.btn-lg {
            width: 50px;
            height: 50px;
            padding: 10px 16px;
            font-size: 18px;
            line-height: 1.33;
            border-radius: 25px;
        }
        .btn-circle.btn-xl {
            width: 70px;
            height: 70px;
            padding: 10px 16px;
            font-size: 24px;
            line-height: 1.33;
            border-radius: 35px;
        }
        /* this CSS is not part of the widget, it is here just as an example of the demo page styling.... Don't copy this one, roll your own. One
 * of the key things about the widget is that it allows you to do your own styling!
 */

        #editor {
            min-height: 100px;
            background-color: white;
            border-collapse: separate;
            border: 1px solid rgb(204, 204, 204);
            padding: 4px 4px 20px;
            box-sizing: content-box;
            -webkit-box-shadow: rgba(0, 0, 0, 0.0745098) 0px 1px 1px 0px inset;
            box-shadow: rgba(0, 0, 0, 0.0745098) 0px 1px 1px 0px inset;
            border-top-right-radius: 3px; border-bottom-right-radius: 3px;
            border-bottom-left-radius: 3px; border-top-left-radius: 3px;
            overflow: hidden;
            outline: none;
        }
        #voiceBtn {
            width: 20px;
            color: transparent;
            background-color: transparent;
            transform: scale(2.0, 2.0);
            -webkit-transform: scale(2.0, 2.0);
            -moz-transform: scale(2.0, 2.0);
            border: transparent;
            cursor: pointer;
            box-shadow: none;
            -webkit-box-shadow: none;
        }

        div[data-role="editor-toolbar"] {
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .dropdown-menu a {
            cursor: pointer;
        }

        #editor .checkbox{
            position: relative;
            display: block;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        #editor.editing-error{
            border-color: red;
            box-shadow: red 0px 1px 1px 0px inset;
        }

        #editor .checkbox label {
            min-height: 20px;
            display: inline-block;
            vertical-align: top;
            margin-bottom: 0;
            font-weight: 400;
            font-size: 16px;
            line-height: 27px;
        }
        #editor .text-center{
            text-align: center;
        }
        #editor .page-break {
            page-break-after: always;
        }
        #editor table{
            table-layout: fixed;
            border:2px solid black;
            width: 900px;
        }
        #editor td{
            border: 1px solid black;
            vertical-align: top;
        }
        #editor footer{
            /*position: relative;
            font-size:12px;
            bottom: -120px;*/
            position: absolute;
            bottom: 0;
            left: 0;
            font-size:12px;
        }
        #editor label{
            font-size: 14px;

        }

        #editor input{
            height: 24px;
            width: 150px;
            font-size: 14px;
        }
        #editor input[type="checkbox"]{
            width: 44px;
        }
        #editor .m-t{
            margin-top: 10px;
        }
        #editor .m-l{
            margin-left: 10px;
        }
        #editor .m-r{
            margin-right:10px;
        }

        #editor .bold{
            font-weight: bold;
        }
        #editor img{
            width: 80px;
            height: 20px;
        }

        #editor .np{
            padding:0px;
        }
        #editor .test{
            background:#e3e3e3;
            padding-top:10px;
        }
        #editor .xsf{
            font-size:13px;
        }
        #editor .box{
            border:2px solid black;
        }
        #editor .pb{
            padding-bottom: 2px;
        }
        #editor hr{
            border: 1px solid black;
        }
        #editor .container{
            position:relative;
            margin-left: 10px;
            margin-right: auto;
            width: 890px;
        }
        #editor .page{
            padding:2px;
        }

        #editor .page-height{
            height: 850px;
            width:900px;
            position: relative;
        }


        #editor .cover{
            position: relative;
            margin-left: auto;
            margin-right: auto;
            width:1200px;
        }
        #editor .in{
            display: inline-block;
            padding:10px;
            vertical-align: top;
        }
        #editor .firstcont{
            height: 375px ;
        }
        #editor .seccont{
            height: 60px;
        }
        #editor .thirdcontent{
            height: 15px;
        }
        #editor .half{
            width: 576px;

        }
        #editor .onehalf{
            width: 242px;
        }
        #editor .onethird{
            width:142px;
        }
        #editor .onetenth{
            width: 10px;
        }
        #editor .fill{
            margin-left: -3px;
        }
        #editor .f{
            margin-left:-1px
        }

        #editor .p-l{
            padding-left: 10px;
        }
        #editor .p-large{
            padding-left: 35px;
            padding-right: 35px;
        }

        #editor .pclass{
            margin-top:5px;padding-left:10px
        }

        #editor .m-t-s{
            margin-top:-5px;
        }
    </style>
@endsection

@section("extrascripts")
    {!! HTML::script("js/jquery.hotkeys.js") !!}
    {!! HTML::script("js/bootstrap-wysiwyg.js") !!}
    {!! HTML::script("js/angular/commonFactory.js") !!}
    {!! HTML::script("js/sweetalert.min.js") !!}
    {!! HTML::script("js/angular/agreement.js") !!}
@endsection