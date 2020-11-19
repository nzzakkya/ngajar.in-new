@extends('layout.app')
@section('content')
@include('layout.alert')
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive" style="max-height: 442px;">
            <table class="table">
                <thead class=" text-primary">
                    <th>Day</th>
                    <th>Hour Start</th>
                    <th>Hour End</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach($schedules as $schedule)
                    <tr>
                        <td>{{ $schedule->day }}</td>
                        <td>{{ $schedule->hour_start }}</td>
                        <td>{{ $schedule->hour_end }}</td>
                        <td>
                            <button type="button" name="edit" class="btn btn-success" data-toggle="modal" data-target="#editSchedule{{ $schedule->id }}">Edit</button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteSchedule{{ $schedule->id }}">Delete</button>
                            <div class="modal fade" id="editSchedule{{ $schedule->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title" id="exampleModalLabel">Schedule</h6>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('dashboard.edit-schedule', ['schedule' => $schedule]) }}" method="post">
                                                @csrf
                                                @method('put')
                                                <div class="form-group">
                                                    <label>Day</label>
                                                    <select class="custom-select @error('day') {{ 'is-invalid' }} @enderror" name="day">
                                                        <option disabled>Select Day:</option>
                                                        <option {{ ($schedule->day == 'sunday') ? 'selected' : ''}} value="sunday">Sunday</option>
                                                        <option {{ ($schedule->day == 'monday') ? 'selected' : ''}} value="monday">Monday</option>
                                                        <option {{ ($schedule->day == 'tuesday') ? 'selected' : ''}} value="tuesday">Tuesday</option>
                                                        <option {{ ($schedule->day == 'wednesday') ? 'selected' : ''}} value="wednesday">Wednesday</option>
                                                        <option {{ ($schedule->day == 'thursday') ? 'selected' : ''}} value="thursday">Thursday</option>
                                                        <option {{ ($schedule->day == 'friday') ? 'selected' : ''}} value="friday">Friday</option>
                                                        <option {{ ($schedule->day == 'saturday') ? 'selected' : ''}} value="saturday">Saturday</option>
                                                    </select>
                                                    @error('day')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Hour Start</label>
                                                    <input class="form-control @error('hour_start') {{ 'is-invalid' }} @enderror" type="time" name="hour_start" value="{{ $schedule->hour_start }}">
                                                    @error('hour_start')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Hour End</label>
                                                    <input class="form-control @error('hour_end') {{ 'is-invalid' }} @enderror" type="time" name="hour_end" value="{{ $schedule->hour_end }}">
                                                    @error('hour_end')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <button class="btn btn-success" type="submit">Save</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="deleteSchedule{{ $schedule->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title" id="exampleModalLabel">Schedule</h6>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('dashboard.edit-schedule', ['schedule' => $schedule]) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <p class="text-center">Are you sure want to delete this schedule ?</p>
                                                <button class="btn btn-success" type="submit">Yes</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <button class="btn btn-primary" data-toggle="modal" data-target="#addSchedule">Add new schedule</button>
    </div>
</div>
<!-- pop up add -->
<div class="modal fade" id="addSchedule" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Schedule</h6>
            </div>
            <div class="modal-body">
                <form action="{{ route('dashboard.add-schedule') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Day</label>
                        <select class="custom-select @error('day') {{ 'is-invalid' }} @enderror" name="day">
                            <option selected disabled>Select Day:</option>
                            <option value="sunday">Sunday</option>
                            <option value="monday">Monday</option>
                            <option value="tuesday">Tuesday</option>
                            <option value="wednesday">Wednesday</option>
                            <option value="thursday">Thursday</option>
                            <option value="friday">Friday</option>
                            <option value="saturday">Saturday</option>
                        </select>
                        @error('day')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Hour Start</label>
                        <input class="form-control @error('hour_start') {{ 'is-invalid' }} @enderror" type="time" name="hour_start">
                        @error('hour_start')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Hour End</label>
                        <input class="form-control @error('hour_end') {{ 'is-invalid' }} @enderror" type="time" name="hour_end">
                        @error('hour_end')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <button class="btn btn-success" type="submit">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection