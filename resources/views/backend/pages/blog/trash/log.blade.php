@extends('backend.master.app')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h1 class="page-title">Log</h1>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <form method="GET" action="{{ route('blog.logviews') }}" class="d-flex">
                    <input type="text" name="search" class="form-control me-2"
                           placeholder="Search logs..." value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">Search</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="page-body page-content">
    <div class="container-xl">
        <div class="card">
            <div class="card-table">
                <div class="table-responsive">
                    @if($logs->isEmpty())
                        <div class="text-center mt-4">
                            <p>No log data found.</p>
                        </div>
                    @else
                    <table class="table card-table table-vcenter table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Created Log</th>
                                <th>Title Article</th>
                                <th>Activity</th>
                                <th>User</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Scheduled Time</th>
                                <th>Article Created</th>
                                <th>Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($logs as $item)
                                @php
                                    $role = null;
                                    if (!empty($item->roles)) {
                                        $decodedRole = json_decode($item->roles, true);
                                        $role = is_array($decodedRole) && isset($decodedRole['name'])
                                            ? $decodedRole['name']
                                            : $item->roles;
                                    }
                                @endphp
                                <tr>
                                    <td>{{ $item->created_datetime ?? '-' }}</td>
                                    <td>{{ $item->title_article ?? '-' }}</td>
                                    <td>{{ ucfirst($item->activity ?? '-') }}</td>
                                    <td>{{ $item->user_name ?? '-' }}</td>
                                    <td>{{ $role ?? '-' }}</td>
                                    <td>{{ ucfirst($item->status ?? '-') }}</td>
                                    <td>{{ $item->scheduled_time ?? '-' }}</td>
                                    <td>{{ $item->article_created_at ?? '-' }}</td>
                                    <td>{{ $item->message ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
            <div class="card-footer">
                {{ $logs->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection