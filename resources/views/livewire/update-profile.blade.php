<div>
    <div class="my-5 ml-5">
        @if($photo_validated)
        <img src="{{ $photo->temporaryUrl() }}" alt="" class="img-thumbnail mx-auto d-block" width="200px" length="200px">
        <br>
        @endif
        <form action="" wire:submit.prevent="save" class="user">
            <div wire:loading wire:target="photo">
                <div class="form-group">
                    <button type="button" class="btn btn-primary btn-user" disabled>Loading...</button>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Upload</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('photo') {{ 'is-invalid' }} @enderror" wire:model.lazy="photo">
                        <label class="custom-file-label" for="inputGroupFile01">{{ $photo_name ?? 'Choose File' }}</label>
                    </div>
                </div>
                @error('photo')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <textarea class="form-control @error('description') {{ 'is-invalid' }} @enderror" wire:model.lazy="description" rows="3">{{ $description }}</textarea>
                @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary btn-user btn-block">Update</button>
        </form>
    </div>
</div>