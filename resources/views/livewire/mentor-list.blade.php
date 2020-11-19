<div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $skill_selected ?? 'Daftar Pengajar' }}</h1>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-2">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Select Skill
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <button type="button" class="dropdown-item" wire:click="resetFilterSkill">Semua</button>
                    @foreach($skills as $skill)
                    <button type="button" class="dropdown-item" wire:click="filterSkill({{ $skill }})">{{ $skill->skill }}</button>
                    @endforeach
                </div>
            </div>
            <div class="col-2">
                <input type="text" class="form-control" wire:model.lazy="search" placeholder="Cari nama mentor">
            </div>
        </div>

    </div>
    <div class="row">
        @foreach($mentors as $mentor)
        <div class="col-xl-3 col-md-3 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="card" style="width:400px">
                            @if($mentor->detail)
                            <img class="card-img-top" src="{{ asset('storage/' . $mentor->detail->photo) }}" alt="Card image" style="width:100%; height:200px">
                            @endif
                            <div class="card-body">
                                <div class="text-center">
                                    <h4 class="card-title text-secondary">{{ $mentor->name }}</h4>
                                    @if($mentor->ratings->isNotEmpty())
                                    @php
                                    $sum = $mentor->ratings->sum('rating');
                                    $count = $mentor->ratings->count('rating');
                                    $rating = round(($sum / $count), 1);
                                    @endphp
                                    <span class="badge badge-pill badge-primary">{{$rating}} Star <i class="fas fa-star"></i></span>
                                    @endif
                                    @foreach($mentor->skills as $skill)
                                    <span class="badge badge-pill badge-primary">{{ $skill->skill }}</span>
                                    @endforeach
                                    <br>
                                    <a href="{{ route('dashboard.mentor-detail', ['user' => $mentor]) }}" class="btn btn-primary">Detail</a>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>