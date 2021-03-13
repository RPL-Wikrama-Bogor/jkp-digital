<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
{{-- A good traveler has no fixed plans and is not intent upon arriving. --}}

    <div class="mb-4">
        <livewire:assignment.create />
    </div>
    <div>
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible">
                <span>{{ session('success') }}</span>
                <button class="close" data-dismiss="alert">&times;</button>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible">
                <span>{{ session('error') }}</span>
                <button class="close" data-dismiss="alert">&times;</button>
            </div>
        @endif
        <div class="card shadow">
            <div class="card-header py-3" wire:click="$emit('refreshData')">
                <h2 class="card-title h6 font-weight-bold text-primary m-0">Assignment</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Minggu ke</th>
                                <th>dari tanggal</th>
                                <th>sampai tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($assignments as $assignment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $assignment->minggu_ke }}</td>
                                    <td>{{ $assignment->from_date }}</td>
                                    <td>{{ $assignment->to_date }}</td>
                                    <td>
                                        {{-- <button class="btn btn-success btn-sm" wire:click="$emit('edit', '{{ $assigmnent->id }}')"><i class="fa fa-edit"></i></button> --}}
                                        <button class="btn btn-danger" onclick="remove()" wire:click="$emit('delete', '{{ $assignment->id }}')"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" align="center">Kosong</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $assignments->links() }}
            </div>
        </div>
    </div>

    {{-- <livewire:assignment.edit /> --}}

</div>

@push('script')
<script>
    const remove = function () {
        return confirm('Yakin hapus data ini?') || event.stopImmediatePropagation()
    }
</script>
@endpush
