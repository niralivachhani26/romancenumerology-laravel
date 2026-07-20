<div class="card mb-4 p-3 rounded-0">
    <h1>{{ $title }}</h1>
    <div class="d-flex justify-content-end">
        @if (!empty($index))
            <a href="{{ $index }}" id="index-btn" class="btn btn-primary btn-pill px-2 py-1 ml-1"><i class="fa fa-list" aria-hidden="true"></i> Index</a>
        @endif
        @if (!empty($add))
            <a href="{{ $add }}" id="add-btn" class="btn btn-primary btn-pill px-2 py-1 ml-1"><i class="fa fa-plus" aria-hidden="true"></i> Create</a>
        @endif
        @if (!empty($edit))
            <a href="{{ $edit }}" id="edit-btn" class="btn btn-primary btn-pill px-2 py-1 ml-1"><i class="fa fa-pencil" aria-hidden="true"></i> Update</a>
        @endif
        @if (!empty($customUrl))
            <a href="{{ $customUrl }}" id="{{ $customName }}-btn" class="btn btn-primary btn-pill px-2 py-1 ml-1"><i class="fa fa-list" aria-hidden="true"></i> {{ ucfirst($customName) }}</a>
        @endif
        @if (!empty($open))
            <a href="{{ $open }}" id="edit-btn" target="_blank" class="btn btn-primary btn-pill px-2 py-1 ml-1"><i class="fa fa-pencil2" aria-hidden="true"></i> Open</a>
        @endif
    </div>
</div>
