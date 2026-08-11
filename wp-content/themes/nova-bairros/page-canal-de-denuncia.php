<?php

/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage None Plate
 * @since None Plate 1.0
 */


get_header(); ?>

<main>
    <?php include 'hero-interna.php'; ?>

    <?php
    $canal = get_field('canal');
    if (!empty($canal) && (!empty($canal['titulo']) || !empty($canal['texto']))):
    ?>
        <section class="fale-conosco">
            <div class="container">
                <div class="flex flex-col lg:grid grid-cols-12 gap-8">
                    <div class="col-span-6">
                        <div class="flex flex-col justify-start gap-3 w-fit items-start">
                            <?php if (!empty($canal['label'])): ?>
                                <span><?= esc_html($canal['label']); ?></span>
                            <?php endif; ?>
                            <?php if (!empty($canal['titulo'])): ?>
                                <h2><?= esc_html($canal['titulo']); ?></h2>
                            <?php endif; ?>
                            <div class="border-b border-(--amarelo) border-[3px] max-w-75 w-full"></div>
                            <?php if (!empty($canal['texto'])): ?>
                                <div class="content mt-10"><?= wp_kses_post($canal['texto']); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <div class="form-container border border-(--verde) bg-white rounded-[10px] shadow-[0_4px_8px_0_#003C2233] px-8 py-6">
                            <h3 class="text-(--verde) mb-4">Realize o seu relato</h3>
                            <form id="ajax-contact-form" action="" method="POST" enctype="multipart/form-data" class="flex flex-col gap-5 mt-8">
                                <input type="hidden" name="form_type" value="canal_denuncia">
                                <?php wp_nonce_field('send_contact_form_nonce', 'nonce'); ?>

                                <div class="form-group flex flex-col gap-2">
                                        <label class="label">Deseja se identificar?</label>
                                        <div class="flex flex-row gap-6" id="radio">
                                            <label class="flex items-center gap-2 cursor-pointer">
                                                <input type="radio" name="identificar" id="identificar-nao" value="nao" checked>
                                                Não
                                            </label>
                                            <label class="flex items-center gap-2 cursor-pointer">
                                                <input type="radio" name="identificar" id="identificar-sim" value="sim">
                                                Sim
                                            </label>
                                        </div>
                                    </div>

                                    <div id="identificacao-fields" style="max-height:0;overflow:hidden;transition:max-height .4s ease">
                                        <div class="flex flex-col gap-5">
                                            <div class="form-group flex flex-col">
                                                <label for="nome">Nome Completo</label>
                                                <input type="text" id="nome" name="nome" placeholder="Nome">
                                            </div>
                                            <div class="form-group flex flex-col">
                                                <label for="email">E-mail</label>
                                                <input type="email" id="email" name="email" placeholder="contato@email.com">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex lg:flex-row flex-col gap-6">
                                        <div class="form-group flex flex-col flex-1">
                                            <label for="tipo_relato">Tipo de Relato</label>
                                            <select id="tipo_relato" name="tipo_relato" required>
                                                <option value="">Selecione</option>
                                                <option value="Conflito de Interesses">Conflito de Interesses</option>
                                                <option value="Assédio Moral ou Sexual">Assédio Moral ou Sexual</option>
                                                <option value="Fraude ou Corrupção">Fraude ou Corrupção</option>
                                                <option value="Descumprimento de Normas">Descumprimento de Normas</option>
                                                <option value="Violação de Dados Pessoais">Violação de Dados Pessoais</option>
                                                <option value="Conduta Antiética">Conduta Antiética</option>
                                                <option value="Outro">Outro</option>
                                            </select>
                                        </div>
                                        <div class="form-group flex flex-col flex-1">
                                            <label for="local_relato">Local do Relato</label>
                                            <input type="text" id="local_relato" name="local_relato" placeholder="Ex: Minas Gerais" required>
                                        </div>
                                    </div>

                                    <div class="form-group flex flex-col">
                                        <label for="descricao">Descrição</label>
                                        <textarea id="descricao" name="descricao" placeholder="Descreva detalhadamente o ocorrido" required></textarea>
                                    </div>

                                    <a id="anexo-trigger" class="flex flex-row justify-between items-center cursor-pointer" href="#"
                                        onclick="document.getElementById('anexo-input').click(); return false;">
                                        <p id="anexo-label">Anexos e Documentação (Word / PDF / JPEG / PNG)</p>
                                        <img src="<?= IMG_URI ?>anexo.svg" alt="anexo" loading="lazy">
                                    </a>
                                    <input type="file" id="anexo-input" name="anexo" class="hidden" accept=".doc,.docx,.pdf,.jpg,.jpeg,.png">

                                    <button type="submit" class="cta self-start">Enviar</button>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
</main>

<?php get_footer(); ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const radios     = document.querySelectorAll('input[name="identificar"]');
        const idFields   = document.getElementById('identificacao-fields');
        const nomeInput  = document.getElementById('nome');
        const emailInput = document.getElementById('email');
        const anexoInput = document.getElementById('anexo-input');
        const anexoLabel = document.getElementById('anexo-label');

        function toggleIdentificacao() {
            const sim = document.getElementById('identificar-sim').checked;
            if (sim) {
                idFields.style.maxHeight = idFields.scrollHeight + 'px';
                if (nomeInput)  nomeInput.required  = true;
                if (emailInput) emailInput.required = true;
            } else {
                idFields.style.maxHeight = '0';
                if (nomeInput)  { nomeInput.required  = false; nomeInput.value  = ''; }
                if (emailInput) { emailInput.required = false; emailInput.value = ''; }
            }
        }

        radios.forEach(function(r) { r.addEventListener('change', toggleIdentificacao); });

        if (anexoInput && anexoLabel) {
            anexoInput.addEventListener('change', function() {
                anexoLabel.textContent = this.files.length ? this.files[0].name : 'Anexos e Documentação (Word / PDF / JPEG / PNG)';
            });
        }

        const form = document.getElementById('ajax-contact-form');
        if (form) {
            function showFormPopupMessage(message, isSuccess) {
                const existingMsg = document.getElementById('form-popup-message');
                if (existingMsg) existingMsg.remove();
                
                const msgDiv = document.createElement('div');
                msgDiv.id = 'form-popup-message';
                msgDiv.className = 'fixed bottom-5 right-5 z-[9999] px-6 py-4 rounded-lg shadow-xl font-medium transition-all duration-500 transform translate-y-10 opacity-0 ' + 
                                   (isSuccess ? 'bg-green-100 text-green-800 border-l-4 border-green-500' : 'bg-red-100 text-red-800 border-l-4 border-red-500');
                msgDiv.innerText = message;
                
                document.body.appendChild(msgDiv);
                
                setTimeout(() => {
                    msgDiv.classList.remove('translate-y-10', 'opacity-0');
                    msgDiv.classList.add('translate-y-0', 'opacity-100');
                }, 10);
                
                setTimeout(() => {
                    msgDiv.classList.remove('translate-y-0', 'opacity-100');
                    msgDiv.classList.add('translate-y-10', 'opacity-0');
                    setTimeout(() => msgDiv.remove(), 500);
                }, 5000);
            }

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const btn = form.querySelector('button[type="submit"]');
                const originalText = btn.innerText;
                btn.innerText = 'Enviando...';
                btn.disabled = true;
                btn.style.opacity = '0.7';
                
                const formData = new FormData(form);
                formData.append('action', 'send_contact_form');
                
                fetch('<?= admin_url('admin-ajax.php') ?>', {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.json())
                .then(res => {
                    showFormPopupMessage(res.data.message || 'Erro ao enviar.', res.success);
                    
                    if (res.success) {
                        form.reset();
                        if (anexoLabel) anexoLabel.textContent = 'Anexos e Documentação (Word / PDF / JPEG / PNG)';
                        toggleIdentificacao();
                    }
                })
                .catch(err => {
                    showFormPopupMessage('Ocorreu um erro inesperado.', false);
                })
                .finally(() => {
                    btn.innerText = originalText;
                    btn.disabled = false;
                    btn.style.opacity = '1';
                });
            });
        }
    });
</script>
