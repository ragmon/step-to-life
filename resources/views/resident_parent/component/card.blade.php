<div class="col-12 col-sm-6 col-md-4 d-flex">
    <div class="card bg-light w-100">
        <div class="card-header text-muted border-bottom-0 pb-0">{{ $parent->role }}</div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <h2 class="lead"><b>{{ $parent->fullname }}</b></h2>
                    <ul class="ml-0 mb-0 fa-ul text-muted">
                        <li class="small"> Телефон: <a href="tel:{{ $parent->phone }}">{{ $parent->phone }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="text-right">
                <a href="{{ route('parents.show', [$parent->id]) }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-user"></i> Подробнее
                </a>
            </div>
        </div>
    </div>
</div>
