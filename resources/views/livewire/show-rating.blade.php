<div>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addreview{{$order->id}}">
        Review
    </button>

    <div class="modal fade" id="addreview{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Review</label>
                                <textarea class="form-control @error('review'){{'is-invalid'}}@enderror" cols="30" rows="3" placeholder="write your review..." @if(!$submit) {{ 'readonly' }} @endif wire:model="review"></textarea>
                                @error('review')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <center>
                                    <div class="h5">{{$star}} Star <i class="fas fa-star"></i></div>
                                </center>
                                <input type="range" class="form-control-range" name="star" min="1" max="5" step="1"  @if(!$submit) {{ 'disabled' }} @endif wire:model="star">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    @if($submit)
                    <button class="btn btn-success" data-dismiss="modal" wire:click="submit">Submit</button>
                    @endif
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>