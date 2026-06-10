<?php

/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage None Plate
 * @since None Plate 1.0
 */

$form_sent  = false;
$form_error = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['canal_denuncia_nonce'])) {
    if (!wp_verify_nonce($_POST['canal_denuncia_nonce'], 'canal_denuncia_submit')) {
        $form_error = true;
    } else {
        $identificar  = sanitize_text_field($_POST['identificar'] ?? 'nao');
        $nome         = sanitize_text_field($_POST['nome'] ?? '');
        $email        = sanitize_email($_POST['email'] ?? '');
        $tipo_relato  = sanitize_text_field($_POST['tipo_relato'] ?? '');
        $local_relato = sanitize_text_field($_POST['local_relato'] ?? '');
        $descricao    = sanitize_textarea_field($_POST['descricao'] ?? '');

        $to      = get_option('admin_email');
        $subject = 'Canal de Denúncia – ' . ($identificar === 'sim' ? $nome : 'Anônimo');

        $body  = "Identificação: " . ($identificar === 'sim' ? "Sim\nRelator: {$nome}\nE-mail: {$email}" : 'Anônimo') . "\n\n";
        $body .= "Tipo de Relato: {$tipo_relato}\n";
        $body .= "Local do Relato: {$local_relato}\n";
        $body .= "\nDescrição:\n{$descricao}\n";

        $headers = ['Content-Type: text/plain; charset=UTF-8'];

        $attachments = [];
        if (!empty($_FILES['anexo']['tmp_name'])) {
            $attachments[] = $_FILES['anexo']['tmp_name'];
        }

        $form_sent = wp_mail($to, $subject, $body, $headers, $attachments);
        if (!$form_sent) {
            $form_error = true;
        }
    }
}

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
                            <?php if ($form_sent): ?>
                                <p class="text-green-600 font-medium mt-6">Relato enviado com sucesso. Obrigado pelo contato.</p>
                            <?php else: ?>
                                <?php if ($form_error): ?>
                                    <p class="text-red-600 font-medium mt-4">Ocorreu um erro ao enviar. Por favor, tente novamente.</p>
                                <?php endif; ?>
                                <form action="" method="POST" enctype="multipart/form-data" class="flex flex-col gap-5 mt-8">
                                    <?php wp_nonce_field('canal_denuncia_submit', 'canal_denuncia_nonce'); ?>

                                    <div class="form-group flex flex-col gap-2">
                                        <label class="label">Deseja se identificar?</label>
                                        <div class="flex flex-row gap-6">
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
                            <?php endif; ?>
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
    });
</script>
