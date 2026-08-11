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
                const existingMsg = document.getElementById('form-popup-overlay');
                if (existingMsg) existingMsg.remove();
                
                const overlayDiv = document.createElement('div');
                overlayDiv.id = 'form-popup-overlay';
                overlayDiv.style.position = 'fixed';
                overlayDiv.style.top = '0';
                overlayDiv.style.left = '0';
                overlayDiv.style.width = '100vw';
                overlayDiv.style.height = '100vh';
                overlayDiv.style.backgroundColor = 'rgba(0,0,0,0.6)';
                overlayDiv.style.zIndex = '99999';
                overlayDiv.style.display = 'flex';
                overlayDiv.style.alignItems = 'center';
                overlayDiv.style.justifyContent = 'center';
                overlayDiv.style.opacity = '0';
                overlayDiv.style.transition = 'opacity 0.3s ease-in-out';
                
                const msgDiv = document.createElement('div');
                msgDiv.style.backgroundColor = isSuccess ? '#00663B' : '#fee2e2';
                msgDiv.style.color = isSuccess ? '#ffffff' : '#991b1b';
                msgDiv.style.padding = '40px 30px';
                msgDiv.style.borderRadius = '12px';
                msgDiv.style.boxShadow = '0 20px 25px -5px rgba(0, 0, 0, 0.1)';
                msgDiv.style.fontWeight = '500';
                msgDiv.style.fontFamily = 'inherit';
                msgDiv.style.textAlign = 'center';
                msgDiv.style.maxWidth = '90%';
                msgDiv.style.width = '400px';
                msgDiv.style.position = 'relative';
                msgDiv.style.transform = 'scale(0.9)';
                msgDiv.style.transition = 'transform 0.3s ease-in-out';
                if (!isSuccess) msgDiv.style.border = '2px solid #ef4444';
                
                const closeBtn = document.createElement('button');
                closeBtn.innerHTML = '&times;';
                closeBtn.style.position = 'absolute';
                closeBtn.style.top = '10px';
                closeBtn.style.right = '15px';
                closeBtn.style.background = 'transparent';
                closeBtn.style.border = 'none';
                closeBtn.style.color = isSuccess ? '#ffffff' : '#991b1b';
                closeBtn.style.fontSize = '24px';
                closeBtn.style.cursor = 'pointer';
                closeBtn.style.lineHeight = '1';
                closeBtn.style.padding = '0';
                
                const textNode = document.createElement('p');
                textNode.innerText = message;
                textNode.style.margin = '0';
                textNode.style.fontSize = '18px';
                
                msgDiv.appendChild(closeBtn);
                msgDiv.appendChild(textNode);
                overlayDiv.appendChild(msgDiv);
                document.body.appendChild(overlayDiv);
                
                document.body.style.overflow = 'hidden';
                
                setTimeout(() => {
                    overlayDiv.style.opacity = '1';
                    msgDiv.style.transform = 'scale(1)';
                }, 10);
                
                function closeModal() {
                    overlayDiv.style.opacity = '0';
                    msgDiv.style.transform = 'scale(0.9)';
                    document.body.style.overflow = '';
                    setTimeout(() => overlayDiv.remove(), 300);
                }
                
                closeBtn.addEventListener('click', closeModal);
                overlayDiv.addEventListener('click', function(e) {
                    if (e.target === overlayDiv) closeModal();
                });
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
