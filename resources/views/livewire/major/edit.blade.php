<div>
    @if ($isOpen)
    <div class="modal backdrop d-block">
        <div class="modal-backdrop" style="background: rgba(0,0,0,.5);">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form wire:submit.prevent="update">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Data</h5>
                            <button type="button" class="close" wire:click="$set('isOpen', false)">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control @error('jurusan.name') is-invalid @enderror"
                                    wire:model="major.name" autofocus>

                                @error('jurusan.name')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary shadow" type="submit">Edit</button>
                            <button type="button" class="btn btn-secondary shadow"
                                wire:click="$set('isOpen', false)">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
