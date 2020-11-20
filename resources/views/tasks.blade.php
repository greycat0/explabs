@extends('layouts.app')

@section('content')
    <!-- Create Task Form... -->

    <!-- Current Tasks -->
    @if (auth()->user()->role == 'admin')
        @if (count($tasks) > 0)
            <div class="panel panel-default">
                <div class="panel-heading">
                    Current Tasks
                </div>

                <div class="panel-body">
                    <table class="table table-hover">

                        <!-- Table Headings -->
                        <thead>
                        <th>Task</th>
                        <th>Delete</th>
                        <th>Change</th>
                        </thead>

                        <!-- Table Body -->
                        <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <!-- Task Name -->
                                <td class="table-text">
                                    <div id="id{{$task->id}}"><span id="name{{$task->id}}">{{ $task->name }}</span></div>
                                </td>

                                <td>
                                    <form action="/task/{{ $task->id }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button class="btn btn-danger">Delete Task</button>
                                    </form>
                                </td>
                                <td>
                                    <button class="btn btn-info" onclick="changeButton('{{$task->id}}', '{{csrf_token()}}')">Change Task</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        <table class="table table-hover">

            <!-- Table Headings -->
            <thead>
            <th>User</th>
            <th>Task</th>
            </thead>

            <tbody>

            {{--@foreach ($tasks as $task)--}}
            {{--@foreach($task->users() as $user)--}}

            {{--<tr>--}}
            {{--<td class="table-text">--}}
            {{--{{$user}}--}}
            {{--</td>--}}

            {{--<td class="table-text">--}}
            {{--{{$task->name}}--}}
            {{--</td>--}}
            {{--</tr>--}}
            {{--@endforeach--}}
            {{--@endforeach--}}
            @foreach($users as $user)
                @foreach($user->tasks as $task)
                    <tr>
                        <td class="table-text">
                            {{$user->name}}
                        </td>
                        <td class="table-text">
                            {{$task->name}}
                        </td>
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
        <div class="panel-body">
            <!-- Display Validation Errors -->


        <!-- New Task Form -->
            <form action="/task" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- Task Name -->
                <div class="form-group">
                    <label for="task-name" class="col-sm-3 control-label">Task</label>

                    <div class="col-sm-6">
                        <input type="text" name="name" id="task-name" class="form-control">
                    </div>
                </div>

                <!-- Add Task Button -->
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-plus"></i> Add Task
                        </button>
                    </div>
                </div>
            </form>





        </div>

        <script src="js/task.js")></script>
    @else
        <div class="panel panel-default">
            @if (count($freeTasks) > 0)
                <div class="panel-heading">
                    Current Tasks
                </div>

                <div class="panel-body">

                    <table class="table table-hover">

                        <!-- Table Headings -->
                        <thead>
                        <th>Task</th>
                        <th>Subscribe</th>
                        </thead>

                        <!-- Table Body -->
                        <tbody>
                        @foreach ($freeTasks as $task)
                            <tr>
                                <!-- Task Name -->
                                <td class="table-text">
                                    <div>{{ $task->name }}</div>
                                </td>

                                <td>
                                    <form action="/task/{{ $task->id }}" method="POST">
                                        {{ csrf_field() }}

                                        <button class="btn btn-success">Subscribe</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @endif
                    @if(count($tasksForUser))
                        Ваши таски:
                        <table class="table table-hover">
                            @foreach ($tasksForUser as $task)
                                <tr>
                                    <!-- Task Name -->
                                    <td class="table-text">
                                        <div>
                                            {{$task->name}}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @endif
                </div>
        </div>
    @endif
@endsection