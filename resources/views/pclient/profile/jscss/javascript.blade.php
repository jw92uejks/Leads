<script>
"use strict";

document.addEventListener('DOMContentLoaded', function () {

  var phoneInput = document.querySelector('input[name="phone"]');
  if (phoneInput) {
    function formatPhone(value) {
      value = value.replace(/\D/g, '');
      if (value.length === 11) {
        return value.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
      } else if (value.length === 10) {
        return value.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
      }
      return value;
    }

    if (phoneInput.value) {
      phoneInput.value = formatPhone(phoneInput.value);
    }

    phoneInput.addEventListener('input', function (e) {
      var value = e.target.value.replace(/\D/g, '');
      if (value.length <= 11) {
        e.target.value = formatPhone(value);
      }
    });

    var form = phoneInput.closest('form');
    if (form) {
      form.addEventListener('submit', function() {
        phoneInput.value = phoneInput.value.replace(/\D/g, '');
      });
    }
  }

  var documentTypeSelect = document.getElementById('document-type-select');
  var cpfInput = document.getElementById('cpf-input');
  var cnpjInput = document.getElementById('cnpj-input');

  if (cpfInput) {
    cpfInput.addEventListener('input', function(e) {
      var value = e.target.value.replace(/\D/g, '');
      if (value.length > 11) value = value.substring(0, 11);
      if (value.length === 11) {
        value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
      }
      e.target.value = value;
    });

    if (cpfInput.value) {
      var cpfValue = cpfInput.value.replace(/\D/g, '');
      if (cpfValue.length === 11) {
        cpfInput.value = cpfValue.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
      }
    }
  }

  if (cnpjInput) {
    cnpjInput.addEventListener('input', function(e) {
      var value = e.target.value.replace(/\D/g, '');
      if (value.length > 14) value = value.substring(0, 14);
      if (value.length === 14) {
        value = value.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, '$1.$2.$3/$4-$5');
      }
      e.target.value = value;
    });

    if (cnpjInput.value) {
      var cnpjValue = cnpjInput.value.replace(/\D/g, '');
      if (cnpjValue.length === 14) {
        cnpjInput.value = cnpjValue.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, '$1.$2.$3/$4-$5');
      }
    }
  }

  if (documentTypeSelect && cpfInput && cnpjInput) {
    var currentCpf = cpfInput.value.replace(/\D/g, '');
    var currentCnpj = cnpjInput.value.replace(/\D/g, '');

    if (!documentTypeSelect.value) {
      if (currentCpf.length === 11) {
        documentTypeSelect.value = '1';
      } else if (currentCnpj.length === 14) {
        documentTypeSelect.value = '2';
      }
    }
  }

  var profileForm = document.getElementById('profile-form');
  if (profileForm && (cpfInput || cnpjInput)) {
    profileForm.addEventListener('submit', function() {
      if (cpfInput && cpfInput.value) {
        cpfInput.value = cpfInput.value.replace(/\D/g, '');
      }
      if (cnpjInput && cnpjInput.value) {
        cnpjInput.value = cnpjInput.value.replace(/\D/g, '');
      }
    });
  }
});


// Funcionalidade para regenerar o token da API
document.addEventListener('DOMContentLoaded', function() {
    const regenerateButton = document.getElementById('regenerate-token');
    const tokenInput = document.querySelector('input[name="ucode"]');

    if (regenerateButton && tokenInput) {
        regenerateButton.addEventListener('click', function() {
            const newToken = generateRandomToken(32);
            tokenInput.value = newToken;
            tokenInput.classList.add('token-regenerated');
            setTimeout(() => {
                tokenInput.classList.remove('token-regenerated');
            }, 2000);
        });
    }
});

// Função para gerar token aleatório
function generateRandomToken(length) {
    const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    let result = '';
    for (let i = 0; i < length; i++) {
        result += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    return result;
}
</script>