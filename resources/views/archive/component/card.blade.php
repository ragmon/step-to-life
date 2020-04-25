<div class="col-12 col-sm-6 col-md-4 d-flex">
    <div class="card bg-light w-100">
        <div class="card-header text-muted border-bottom-0">
            {{ "Баланс: $resident->balance" }}
        </div>
        <div class="card-body pt-0">
            <div class="row">
                <div class="col-12">
                    <h2 class="lead"><b>{{ $resident->fullname }}</b></h2>
                    <ul class="ml-0 mb-0 fa-ul text-muted">
                        <li class="small"> Пол: {{ $resident->gender_title }}</li>
                        <li class="small"> День рождения: {{ $resident->birthday ? $resident->birthday->format('d.m.Y') : '-' }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="text-right">
                <a href="{{ route('archive.show', [$resident->id]) }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-user"></i> Подробнее
                </a>
            </div>
        </div>
    </div>
</div>
