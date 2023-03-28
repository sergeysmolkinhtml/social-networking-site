@extends('base')

@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('groups.create') }}">
                Create group
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Group list</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-danger" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="d-flex justify-content-end">
                <form action="{{ route('groups.index') }}" method="GET">
                    <div class="form-group row">
                        <label for="status" class="col-form-label">Status:</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="status" id="status" onchange="this.form.submit()">
                                <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>All</option>
                                @foreach(App\Models\Group::STATUS as $status)
                                    <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                                        {{ ucfirst($status) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>

            <table class="table table-responsive-sm table-striped">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($groups as $group)
                    <tr>
                        <td><a href="{{ route('groups.show', $group) }}">{{ $group->title }}</a></td>
                        <td>{{ $group->description }}</td>
                        <td>{{ $group->status }}</td>
                        <td>
                            <a class="btn btn-sm btn-info" href="{{ route('groups.edit', $group) }}">
                                Edit
                            </a>
                                @can('delete')
                                <form action="{{ route('groups.destroy', $group) }}" method="POST" onsubmit="return confirm('Are your sure?');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-sm btn-danger" value="Delete">
                                </form>
                            @endcan

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $groups->withQueryString()->links() }}
        </div>
    </div>
@endsection
