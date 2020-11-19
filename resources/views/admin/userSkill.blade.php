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
                    @foreach($skills as $skill)
                    <tr>
                        <td>{{ $skill->skill }}</td>
                        <td>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteSkill{{ $skill->id }}">Delete</button>
                            <!-- pop up delete -->
                            <div class="modal fade" id="deleteSkill{{ $skill->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title" id="exampleModalLabel">Skill</h6>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('dashboard.delete-user-skill', ['skill' => $skill]) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <p>Are you sure want to delete this skill ?</p>
                                                <button type="submit" class="btn btn-success">Yes</button>
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
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSkill">Add New Skill</button>

        <!-- pop up add -->
        <div class="modal fade" id="addSkill" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">Skill</h6>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('dashboard.add-user-skill') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Skill</label>
                                <div class="form-group">
                                    <input class="form-control @error('skill') {{ 'is-invalid' }} @enderror" type="text" name="skill" value="{{ old('name') ?? '' }}">
                                    @error('skill')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
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