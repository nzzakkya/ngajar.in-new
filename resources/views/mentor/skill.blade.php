@extends('layout.app')
@section('content')
@include('layout.alert')
<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body">
        <div class="table-responsive" style="max-height: 442px;">
            <table class="table">
                <thead class=" text-primary">
                    <th>Skill</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach($user_skills as $user_skill)
                    <tr>
                        <td>{{ $user_skill->skill }}</td>
                        <td>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteSkill{{ $user_skill->id }}">Delete</button>
                            <!-- pop up delete -->
                            <div class="modal fade" id="deleteSkill{{ $user_skill->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title" id="exampleModalLabel">Skill</h6>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('dashboard.delete-skill', ['id' => $user_skill->id]) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <p>Are you sure want to delete this skill ?</p>
                                                <button type="submit" class="btn btn-success">Yes</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
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
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSkill">Add New Skill</button>

        <!-- pop up add -->
        <div class="modal fade" id="addSkill" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">Skill</h6>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('dashboard.add-skill') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Skill</label>
                                <select class="custom-select @error('skill') {{ 'is-invalid' }} @enderror" name="skill">
                                    <option selected disabled>Select Skill:</option>
                                    @foreach($skills as $skill)
                                    <option value="{{ $skill->id }}">{{ $skill->skill }}</option>
                                    @endforeach
                                </select>
                                @error('skill')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-success">Save</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection