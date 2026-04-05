<!-- Hero modifié (hero.php) -->
<div class='hero' id="hero-demo" <?= ($email_stored || $demo_mode) ? 'style="display:none;"' : '' ?>>
    <div class='hero-content'>
        <div class="badge"><?= t('badge_demo', 'hero') ?></div>
        
        <h1><?= t('hero_titulo', 'hero') ?></h1>
        
        <p class="subtitle">
            <?= t('hero_subtitulo', 'hero') ?>
        </p>

        <!-- SECTION PROMOTION 1 MES GRATIS -->
        <div class="promo-box">
            <div class="promo-badge">🎁</div>
            <div class="promo-content">
                <h3 class="promo-title"><?= t('promo_titulo', 'hero') ?></h3>
                <p class="promo-desc"><?= t('promo_desc', 'hero') ?></p>
                <div class="promo-features">
                    <span class="promo-feature">✓ <?= t('promo_feature_1', 'hero') ?></span>
                    <span class="promo-feature">✓ <?= t('promo_feature_2', 'hero') ?></span>
                    <span class="promo-feature">✓ <?= t('promo_feature_3', 'hero') ?></span>
                </div>
                <div class="promo-cta">
                    <span class="promo-highlight"><?= t('promo_sin_compromiso', 'hero') ?></span>
                </div>
            </div>
        </div>

        <!-- PRIX -->
        <div class="price-box">
            <div class="price-main">
                <span class="price-value">1 000 000 COP</span>
                <span class="price-label"><?= t('hero_prix_initial', 'hero') ?></span>
            </div>
            <div class="price-recurrent">
                <span class="price-value">Desde 300 000 COP</span>
                <span class="price-label"><?= t('hero_prix_mensuel', 'hero') ?></span>
            </div>
        </div>

        <div class='features'>
            <div class="feature-item">
                <span class="check">✓</span>
                <span><?= t('hero_feature_1', 'hero') ?></span>
            </div>
            <div class="feature-item">
                <span class="check">✓</span>
                <span><?= t('hero_feature_2', 'hero') ?></span>
            </div>
            <div class="feature-item">
                <span class="check">✓</span>
                <span><?= t('hero_feature_3', 'hero') ?></span>
            </div>
        </div>

        <!-- MODULARITÉ -->
        <div class="modular-box">
            <div class="modular-icon">🔧</div>
            <div class="modular-content">
                <h3><?= t('hero_modular_titre', 'hero') ?></h3>
                <p><?= t('hero_modular_desc', 'hero') ?></p>
                <div class="modular-options">
                    <span class="modular-option">API</span>
                    <span class="modular-option">Email</span>
                    <span class="modular-option"><?= t('hero_modular_fichier', 'hero') ?></span>
                    <span class="modular-option"><?= t('hero_modular_custom', 'hero') ?></span>
                </div>
            </div>
        </div>

        <!-- FORMULAIRE EMAIL -->
        <form method="POST" action="" class="demo-form" id="email-entry-form">
            <p class="form-label"><?= t('hero_email_label', 'hero') ?></p>
            
            <div class="input-group">
                <input 
                    type="email" 
                    id="demo-email"
                    name="demo_email"
                    placeholder="<?= t('hero_email_placeholder', 'hero') ?>"
                    class="input-email"
                    required
                >
                <button type="submit" class="btn btn-primary">
                    <?= t('hero_boton', 'hero') ?>
                    <span class="arrow">→</span>
                </button>
            </div>
            <p class="form-hint"><?= t('hero_email_hint', 'hero') ?></p>
        </form>

        <!-- BOUTON SOUSCRIPTION ÉCOLE -->
        <div class="suscripcion-box">
            <div class="suscripcion-divider">
                <span>o</span>
            </div>
            <a href="/suscripcion?lang=<?= $idioma_actual ?>" class="btn-suscripcion">
                <span class="suscripcion-icon">🎓</span>
                <span class="suscripcion-text">
                    <span class="suscripcion-main"><?= t('btn_suscripcion', 'hero') ?></span>
                    <span class="suscripcion-sub"><?= t('btn_suscripcion_sub', 'hero') ?></span>
                </span>
                <span class="suscripcion-arrow">→</span>
            </a>
        </div>

        <div class='trust'>
            <span class="trust-icon">⚙️</span>
            <span><?= t('hero_trust', 'hero') ?></span>
        </div>
    </div>
    <div class="hero-decoration"></div>
</div>