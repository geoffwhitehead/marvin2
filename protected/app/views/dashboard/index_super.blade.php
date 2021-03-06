{{ HTML::script('sximo/js/plugins/chartjs/Chart.min.js') }}
<div class="page-content row">
    <div class="page-header">
        <div class="page-title">
            <h3> Dashboard
                <small> Summary info site</small>
            </h3>
        </div>

        <ul class="breadcrumb">
            <li><a href="{{ URL::to('dashboard') }}">Home</a></li>
            <li class="active">Dashboard</li>
        </ul>

    </div>
    <div class="page-content-wrapper">
        <div class="col-md-12">

            @if(Session::has('message'))
                    {{ Session::get('message') }}
                </div>
            @endif
            <!-- these select boxes will control which site and department are currently active in the session variables-->
            <div class="panel panel-default">
              <!-- <div class="panel-heading">
                    <div class="panel-title"><h3>Select your current site and department</h3></div>
                </div>-->

                <div class="panel-body" >
                    <div>
                        <label for = "site_id">Site</label><br/>
                        <select name='site_id' rows='5' id='site_id' class='select2 '>

                            @foreach ($sites as $site)
                                @if ($site->id == Session::get('sid'))
                                    <option selected value="{{$site->id}}">{{$site->name}}
                                        , {{$site->address_city}}</option>
                                @else
                                    <option value="{{$site->id}}">{{$site->name}}, {{$site->address_city}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for ="dep_id">Department:</label><br/>
                        <select name='dep_id' rows='5' id='dep_id' class='select2 '>
                            @foreach ($departments as $dep)
                                @if ($dep->id == Session::get('did'))
                                    <option selected value=" {{$dep->id}}"> {{$dep->name}}</option>
                                @else
                                    <option value=" {{$dep->id}}"> {{$dep->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>
                <div class="alert alert-info" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Info:</span>
                    <p><strong>Note: </strong> As an admin you should have global access to sites. Your views will be filtered by this site. This is something i'm currently testing. The user experience may be hindered by having to switch between sites or it may be made less confusing by not seeing all records at once.</p>
                </div>
                <section>

                    <div class=" row m-l-none m-r-none m-t white-bg shortcut ">
                        <div class="col-sm-6 col-md-3 b-r  p-sm ">
                            <span class="pull-left m-r-sm text-navy"><i class="fa fa-plus-circle"></i></span>
                            <a href="{{ URL::to('module/add') }}" class="clear">
					<span class="h3 block m-t-xs"><strong> Modules </strong>
					</span>
                                <small class="text-muted text-uc"> Manage Existing Modules or Create new one</small>
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-3 b-r  p-sm">
                            <span class="pull-left m-r-sm text-info">	<i class="fa fa-cogs"></i></span>
                            <a href="{{ URL::to('config') }}" class="clear">
					<span class="h3 block m-t-xs"><strong>Setting</strong>
					</span>
                                <small class="text-muted text-uc"> Setting Up your application login option , sitename ,
                                    email etc.
                                </small>
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-3 b-r  p-sm">
                            <span class="pull-left m-r-sm text-warning">	<i class="fa fa-sitemap"></i></span>
                            <a href="{{ URL::to('menu') }}" class="clear">
                                <span class="h3 block m-t-xs"><strong> Site Menu </strong></span>
                                <small class="text-muted text-uc">Manage Menu for your application frontend or backend
                                </small>
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-3 b-r  p-sm">
                            <span class="pull-left m-r-sm ">	<i class="fa fa-users"></i></span>
                            <a href="{{ URL::to('users') }}" class="clear">
				<span class="h3 block m-t-xs"><strong>Users & Groups</strong>
				</span>
                                <small class="text-muted text-uc">Manage groups and users and grant what module and menu
                                    are
                                    accessible
                                </small>
                            </a>
                        </div>
                    </div>
                </section>


                <div class="row m-t">
                    <div class="col-md-12">
                        <div class="sbox">
                            <div class="sbox-title">
                                <h3> Sample Chart
                                    <small> ( Plugins js using Chart Js )</small>
                                </h3>
                            </div>
                            <div class="sbox-content">
                                <div class="row">
                                    <div class="col-md-11">
                                        <canvas id="canvas" width="350" height="200"></canvas>
                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>


                </div>
        </div>

    </div>
</div>
<script>

    $("#site_id").change(function () {
        $sid = $("#site_id option:selected").val();
        $.ajax({
            type: 'POST',
            url: 'changesite',
            dataType: 'json',
            data: {
                sid: $sid
            },
            success: function (data) {
                if (data === 'success'){
                    window.location.href = "dashboard";
                }

            }
        });
    });

    $("#dep_id").change(function () {
        $did = $("#dep_id option:selected").val();
        alert($did);
        $.ajax({
            type: 'POST',
            url: 'changedep',
            dataType: 'json',
            data: {
                did: $did
            }
            ,
            success: function (data) {
                if (data === 'success'){
                    window.location.href = "dashboard";
                }

            }
        });
    });


    var randomScalingFactor = function () {
        return Math.round(Math.random() * 100)
    };
    var lineChartData = {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [
            {
                label: "My First dataset",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
            },
            {
                label: "My Second dataset",
                fillColor: "rgba(151,187,205,0.2)",
                strokeColor: "rgba(151,187,205,1)",
                pointColor: "rgba(151,187,205,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(151,187,205,1)",
                data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
            }
        ]

    }

    window.onload = function () {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myLine = new Chart(ctx).Line(lineChartData, {
            responsive: true
        });
    }

</script>