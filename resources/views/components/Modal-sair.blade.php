

          
  <!-- Modal -->
  <div class="modal fade" id="teste" tabindex="-1" aria-labelledby="testeLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
<!-- fin modal -->

<!-- Button -->
  <div class="btn-group dropstart">
    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
        aria-expanded="false" id="btlogar">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
            class="bi bi-box-arrow-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
            <path fill-rule="evenodd"
                d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
        </svg>
    </button>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">Perfil</a></li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li><a class="dropdown-item"data-bs-toggle="modal" data-bs-target="#teste" >Sair</a></li>
    </ul>
</div>
<!-- Button fim -->