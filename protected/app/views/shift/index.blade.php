{{--*/ usort($tableGrid, "SiteHelpers::_sort") /*--}}
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>

      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
        <li class="active">{{ $pageTitle }}</li>
      </ul>	  
	  
    </div>
	
	
	<div class="page-content-wrapper">
    <div class="toolbar-line ">
			@if($access['is_add'] ==1)
	   		<a href="{{ URL::to('shift/add?md='.$masterdetail["filtermd"].$trackUri) }}" class="tips btn btn-xs btn-info"  title="{{ Lang::get('core.btn_create') }}">
			<i class="fa fa-plus"></i>&nbsp;{{ Lang::get('core.btn_create') }}</a>
			@endif  
			@if($access['is_remove'] ==1)
			<a href="javascript://ajax"  onclick="SximoDelete();" class="tips btn btn-xs btn-danger" title="{{ Lang::get('core.btn_remove') }}">
			<i class="fa fa-trash-o"></i>&nbsp;{{ Lang::get('core.btn_remove') }}</a>
			@endif 		
			@if($access['is_excel'] ==1)
			<a href="{{ URL::to('shift/download?md='.$masterdetail["filtermd"].$trackUri) }}" class="tips btn btn-xs btn-default" title="{{ Lang::get('core.btn_download') }}">
			<i class="fa fa-download"></i>&nbsp;{{ Lang::get('core.btn_download') }} </a>
			@endif		
		 	@if(Session::get('gid') ==1)
			<a href="{{ URL::to('module/config/shift') }}" class="tips btn btn-xs btn-default"  title="{{ Lang::get('core.btn_config') }}">
			<i class="fa fa-cog"></i>&nbsp;{{ Lang::get('core.btn_config') }} </a>	
			@endif  			
	 
	</div> 	
	 
		
	@if(Session::has('message'))	  
		   {{ Session::get('message') }}
	@endif	
	{{ $details }}
	
	 {{ Form::open(array('url'=>'shift/destroy/', 'class'=>'form-horizontal' ,'id' =>'SximoTable' )) }}
	 <div class="table-responsive" style="min-height:300px;">
    <table class="table table-striped ">
        <thead>
			<tr>
				<th> No </th>
				<th> <input type="checkbox" class="checkall" /></th>
				
				@foreach ($tableGrid as $t)
					@if($t['view'] =='1')
						<th>{{ $t['label'] }}</th>
					@endif
				@endforeach
				<th>{{ Lang::get('core.btn_action') }}</th>
			  </tr>
        </thead>

        <tbody>
			<tr id="sximo-quick-search" >
				<td> # </td>
				<td> </td>
				@foreach ($tableGrid as $t)
					@if($t['view'] =='1')
					<td>						
						{{ SiteHelpers::transForm($t['field'] , $tableForm) }}								
					</td>
					@endif
				@endforeach
				<td style="width:130px;">
				<input type="hidden"  value="Search">
				<button type="button"  class=" do-quick-search btn btn-xs btn-info"> GO</button></td>
			  </tr>				
            @foreach ($rowData as $row)
                <tr>
					<td width="50"> {{ ++$i }} </td>
					<td width="50"><input type="checkbox" class="ids" name="id[]" value="{{ $row->id }}" />  </td>									
				 @foreach ($tableGrid as $field)
					 @if($field['view'] =='1')
					 <td>					 
					 	@if($field['attribute']['image']['active'] =='1')
							{{ SiteHelpers::showUploadedFile($row->$field['field'],$field['attribute']['image']['path']) }}
						@else	
							{{--*/ $conn = (isset($field['conn']) ? $field['conn'] : array() ) /*--}}
							{{ SiteHelpers::gridDisplay($row->$field['field'],$field['field'],$conn) }}	
						@endif						 
					 </td>
					 @endif					 
				 @endforeach
				 <td>
					 <div class="btn-group">		
						<button class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown"  aria-expanded="false">
						<i class="fa fa-cog"></i> <span class="caret"></span>
						</button>
						<ul  class="dropdown-menu  icons-left pull-right">					 	
						{{--*/ $id = SiteHelpers::encryptID($row->id) /*--}}
					 	@if($access['is_detail'] ==1)
						<li><a href="{{ URL::to('shift/show/'.$id.'?md='.$masterdetail["filtermd"].$trackUri)}}" ><i class="fa  fa-search"></i> {{ Lang::get('core.btn_view') }}</a></li>
						@endif
						@if($access['is_edit'] ==1)
						<li><a  href="{{ URL::to('shift/add/'.$id.'?md='.$masterdetail["filtermd"].$trackUri)}}" ><i class="fa fa-edit"></i> {{ Lang::get('core.btn_edit') }}</a></li>
						@endif
						@foreach($subgrid as $md)
						<li><a href="{{ URL::to($md['module'].'?md='.$md['master'].'+'.$md['master_key'].'+'.$md['module'].'+'.$md['key'].'+'.$id) }}" ><i class="icon-eye2"></i> {{ $md['title'] }}</a></li>
						@endforeach							
						</ul>
					</div>						
				</td>				 
                </tr>
				
            @endforeach
              
        </tbody>
      
    </table>
         <div id='external-events'><h4>Shifts</h4>
             
             <span class='label label-primary'>Hanna</span>
             <span class='label label-primary'>May</span>
             <span class='label label-primary'>Beth</span>
             <span class='label label-primary'>Gavin</span><br />
             <span class='label label-primary'>Hanna</span>
             <span class='label label-primary'>May</span>
             <span class='label label-primary'>Beth</span>
             <span class='label label-primary'>Gavin</span><br />
             <span class='label label-primary'>Hanna</span>
             <span class='label label-primary'>May</span>
             <span class='label label-primary'>Beth</span>
             <span class='label label-primary'>Gavin</span><br />
         </div>
         <div id='calendar'></div>
	<input type="hidden" name="md" value="{{ $masterdetail['filtermd']}}" />
	</div>
	{{ Form::close() }}
	@include('footer')
	
	</div>	  
</div>
<script>
$(document).ready(function(){

	$('.do-quick-search').click(function(){
		$('#SximoTable').attr('action','{{ URL::to("shift/multisearch")}}');
		$('#SximoTable').submit();
	});
	
});	
</script>
<script type="text/javascript">
    $(document).ready(function() {

        $('#external-events span').each(function() {

            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
            };

            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);

            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 999,
                revert: true,      // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
            });

        });



        // page is now ready, initialize the calendar...

        $('#calendar').fullCalendar({
            // put your options and callbacks here
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            defaultView: 'agendaWeek',
            defaultDate: '{{date('Y-m-d')}}',
            editable: true,
            droppable: true,
            eventLimit: true, // allow "more" link when too many events
            eventResize: function( event, delta, revertFunc, jsEvent, ui, view ) {
                $.ajax({
                    url: ("/event/edit"),
                    data: ({
                        id: event.id,
                        start: event.start.format(),
                        end: event.end.format()
                    }),
                    type: "POST",
                    success: function (data) {
                        alert("success");
                        //$('#calendar').fullCalendar('refetchEvents');
                    },
                    error: function (xhr, status, error) {
                        alert("fail");
                        revertFunc();
                    }
                });
            },
            eventDrop: function(event, delta, revertFunc, jsEvent, ui, view) {

                //alert("/event/" + event.id + "/" + event.start.format() + "/" + event.end.format());
                $.ajax({
                    url: ("/event/edit"),
                    data: ({
                        id: event.id,
                        start: event.start.format(),
                        end: event.end.format()
                    }),
                    type: "POST",
                    success: function (data) {
                        alert("success");
                        //$('#calendar').fullCalendar('refetchEvents');
                    },
                    error: function (xhr, status, error) {
                        alert("fail");
                        revertFunc();
                    }
                });

            },
            drop: function(date, allDay) {
                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject');

                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);

                // assign it the date that was reported
                copiedEventObject.start = date;
                copiedEventObject.end = date;

                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                var $gavDate = moment(date);

                $.ajax({
                    url: ("/event/create"),
                    data: ({
                        id: 1,
                        start: moment(date).format(),
                        end: moment(date).add(5, 'hours').format()
                    }),
                    type: "POST",
                    success: function (data) {
                        alert("success");
                    },
                    error: function (xhr, status, error) {
                        alert("fail");
                    }
                });
            },
            timeFormat: 'h:mm',
            eventSources: [
                {
                    url: '/event/list',
                    type: 'GET',
                    data: {
                        custom_param1: 'manager_conf_flag',
                        custom_param2: 'admin_conf_flag',
                        custom_param3: 'paid',
                        custom_param4: 'last_name'
                    },
                    error: function() {
                        alert('there was an error while fetching events!');
                    }
                }
            ]
        })

    });
</script>