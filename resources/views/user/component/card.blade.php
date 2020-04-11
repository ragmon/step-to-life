<div class="col-12 col-sm-6 col-md-4 d-flex">
    <div class="card bg-light w-100">
        <div class="card-header text-muted border-bottom-0">
            {{ $user->role }}
        </div>
        <div class="card-body pt-0">
            <div class="row">
                <div class="col-12">
                    <h2 class="lead"><b>{{ "$user->firstname $user->lastname $user->patronymic" }}</b></h2>
                    <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-at"></i></span> E-mail: <a
                                href="mailto:{{ $user->email }}">{{ $user->email }}</a></li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Телефон: <a
                                href="tel:{{ $user->phone }}">{{ $user->phone }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="text-right">
                {{--            <a href="{{ route('users.edit', [$user->id]) }}" class="btn btn-sm bg-teal">--}}
                {{--                <i class="fas fa-user-edit"></i>--}}
                {{--            </a>--}}
                <a href="{{ route('users.show', [$user->id]) }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-user"></i> Подробнее
                </a>
            </div>
        </div>
    </div>
</div>
