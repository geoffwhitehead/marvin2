<div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
        <div class="page-title">
            <h3> {{ $pageTitle }}
                <small>{{ $pageNote }}</small>
            </h3>
        </div>
        <ul class="breadcrumb">
            <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
            <li><a href="{{ URL::to('trainingtasks?md='.$filtermd) }}">{{ $pageTitle }}</a></li>
            <li class="active">{{ Lang::get('core.addedit') }} </li>
        </ul>

    </div>

    <div class="page-content-wrapper">
        @if(Session::has('message'))
            {{ Session::get('message') }}
        @endif
        <ul class="parsley-error-list">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        {{ Form::open(array('url'=>'trainingtasks/save/'.SiteHelpers::encryptID($row['id']).'?md='.$filtermd.$trackUri, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) }}
        <div class="col-md-12">
            <fieldset>
                <legend> Training Tasks</legend>

                <div class="form-group hidethis " style="display:none;">
                    <label for="Id" class=" control-label col-md-4 text-left"> Id </label>

                    <div class="col-md-6">
                        {{ Form::text('id', $row['id'],array('class'=>'form-control', 'placeholder'=>'',   )) }}
                    </div>
                    <div class="col-md-2">

                    </div>
                </div>
                <div class="form-group  ">
                    <label for="Task Name" class=" control-label col-md-4 text-left"> Task Name <span
                                class="asterix"> * </span></label>

                    <div class="col-md-6">
									  <textarea name='task_name' rows='2' id='task_name' class='form-control '
                                                required>{{ $row['task_name'] }}</textarea>
                    </div>
                    <div class="col-md-2">

                    </div>
                </div>
                <div class="form-group  ">
                    <label for="Global" class=" control-label col-md-4 text-left"> Apply to all Sites? </label>

                    <div class="col-md-6">

                        <input type='checkbox' name='global_site_flag' id='global_site_flag' value='1'  @if($row['global_site_flag'] == '1')
                               checked="checked" @endif >
                    </div>
                    <div class="col-md-2">

                    </div>
                </div>
                @if ($row['id'] != "")
                <div class="form-group  ">
                    <div class=" control-label col-md-4 text-left"></div>

                    <div class="alert alert-warning col-md-6" role = "alert">

                        <p> <p><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                            <span class="sr-only">Info:</span>
                            At the moment, applying a global status will only affect new employees. Current staff will <strong>not</strong> receive this training task. Ideally it would be better to wait for me to implement this feature, but you can apply it now if you need to. -Geoff</p>
                    </div>
                    <div class="col-md-2">

                    </div>
                </div>
                @endif
                <!--only show if new entry-->
                @if ($row['id'] == "")


                    <div class="form-group">
                        <label for="Site Id" class=" control-label col-md-4 text-left"> Site Id </label>

                        <div class="col-md-6">
                            <select name='site_id' rows='5' id='site_id' code='{$site_id}'
                                    class='select2 ' required></select>
                        </div>
                        <div class="col-md-2">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Department Id" class=" control-label col-md-4 text-left"> Department Id </label>

                        <div class="col-md-6">
                            <select name='department_id' rows='5' id='department_id' code='{$department_id}'
                                    class='select2 ' required></select>
                        </div>
                        <div class="col-md-2">

                        </div>
                    </div>
                @endif
                <div class="form-group  ">
                    <label for="Category Id" class=" control-label col-md-4 text-left"> Category Id </label>

                    <div class="col-md-6">
                        <select name='category_id' rows='5' id='category_id' code='{$category_id}'
                                class='select2 ' required></select>
                    </div>
                    <div class="col-md-2">

                    </div>
                </div>
                <div class="form-group  ">
                    <label for="Task Description" class=" control-label col-md-4 text-left"> Task Description <span
                                class="asterix"> * </span></label>

                    <div class="col-md-6">
                        {{ Form::text('task_description', $row['task_description'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true'  )) }}
                    </div>
                    <div class="col-md-2">

                    </div>
                </div>
                <!--only show if editing entry-->
                @if ($row['id'] != "")
                    <div class="form-group  ">
                        <label for="Active" class=" control-label col-md-4 text-left"> Active </label>

                        <div class="col-md-6">

                            <label class='radio radio-inline'>
                                <input type='radio' name='active' value='0'  @if($row['active'] == '0')
                                       checked="checked" @endif > Inactive </label>
                            <label class='radio radio-inline'>
                                <input type='radio' name='active' value='1'  @if($row['active'] == '1')
                                       checked="checked" @endif > Active </label>
                        </div>
                        <div class="col-md-2">

                        </div>
                    </div>
                @endif

            </fieldset>
        </div>


        <div style="clear:both"></div>

        <div class="form-group">
            <label class="col-sm-4 text-right">&nbsp;</label>

            <div class="col-sm-8">

                <div class="form-group  ">
                    @if ($row['id'] != "")
                        <input type="submit" name="apply" class="btn btn-info"
                               value="{{ Lang::get('core.sb_apply') }} "/>
                    @else
                        <input type="submit" name="submit" class="btn btn-primary"
                               value="{{ Lang::get('core.sb_save') }}  "/>
                    @endif
                    <button type="button"
                            onclick="location.href='{{ URL::to('trainingtasks?md='.$masterdetail["filtermd"].$trackUri) }}' "
                            id="submit" class="btn btn-success ">  {{ Lang::get('core.sb_cancel') }} </button>
                </div>

            </div>

            {{ Form::close() }}
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {

        $("#department_id").jCombo("{{ URL::to('trainingtasks/comboselect?filter=departments:id:name') }}",
                {selected_value: '{{ $row["department_id"] }}'});

        $("#site_id").jCombo("{{ URL::to('trainingtasks/comboselect?filter=sites:id:address_city') }}",
                {selected_value: '{{ $row["site_id"] }}'});

        $("#category_id").jCombo("{{ URL::to('trainingtasks/comboselect?filter=training_categories:id:name') }}",
                {selected_value: '{{ $row["category_id"] }}'});

        $("input[name='global_site_flag']").on('ifChecked', function (event) {
            $('#site_id').prop('disabled', true);
        });
        $("input[name='global_site_flag']").on('ifUnchecked', function (event) {
            $('#site_id').prop('disabled', false);
        });
    });
</script>