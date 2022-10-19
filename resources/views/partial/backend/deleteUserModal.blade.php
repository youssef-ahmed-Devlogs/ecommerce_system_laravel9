<!-- Logout Modal-->
<div class="modal fade" id="deleteUserModal-{{ $loop->iteration }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">You will delete this user</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Are you sure?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                <form action="{{ route('backend.users.destroy', $user->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-danger" type="submit">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
