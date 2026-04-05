 .hero {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 60px 20px;
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
    color: white;
    position: relative;
    overflow: hidden;
}

/* Élément décoratif animé */
.hero-decoration {
    position: absolute;
    top: -50%;
    right: -20%;
    width: 800px;
    height: 800px;
    background: radial-gradient(circle, rgba(99, 102, 241, 0.15) 0%, transparent 70%);
    animation: pulse 4s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); opacity: 0.5; }
    50% { transform: scale(1.1); opacity: 0.8; }
}

.hero-content {
    max-width: 680px;
    position: relative;
    z-index: 2;
}

/* Badge moderne */
.badge {
    display: inline-block;
    background: rgba(99, 102, 241, 0.2);
    border: 1px solid rgba(99, 102, 241, 0.4);
    color: #818cf8;
    padding: 8px 20px;
    border-radius: 50px;
    font-size: 0.85rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 24px;
    backdrop-filter: blur(10px);
}

.hero h1 {
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 20px;
    line-height: 1.1;
    background: linear-gradient(135deg, #ffffff 0%, #94a3b8 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.subtitle {
    font-size: 1.25rem;
    color: #94a3b8;
    margin-bottom: 40px;
    line-height: 1.6;
    max-width: 540px;
    margin-left: auto;
    margin-right: auto;
}

/* Features en grille moderne */
.features {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-bottom: 40px;
    text-align: left;
    max-width: 400px;
    margin-left: auto;
    margin-right: auto;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 1.1rem;
    color: #e2e8f0;
}

.check {
    width: 24px;
    height: 24px;
    background: linear-gradient(135deg, #10b981, #059669);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
    flex-shrink: 0;
}

/* Formulaire moderne */
.demo-form {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 16px;
    padding: 32px;
    margin-bottom: 24px;
    backdrop-filter: blur(10px);
}

.form-label {
    color: #cbd5e1;
    font-size: 1rem;
    margin-bottom: 16px;
    margin-top: 0;
}

.input-group {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    justify-content: center;
}

.input-email {
    flex: 1;
    min-width: 240px;
    padding: 14px 18px;
    border-radius: 12px;
    border: 2px solid rgba(255, 255, 255, 0.1);
    background: rgba(255, 255, 255, 0.05);
    color: white;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.input-email::placeholder {
    color: #64748b;
}

.input-email:focus {
    outline: none;
    border-color: #6366f1;
    background: rgba(255, 255, 255, 0.1);
}

/* Boutons modernisés */
.buttons {
    display: flex;
    gap: 16px;
    justify-content: center;
    flex-wrap: wrap;
    margin-top: 32px;
}

.btn {
    padding: 14px 28px;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-primary {
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    color: white;
    box-shadow: 0 4px 20px rgba(99, 102, 241, 0.4);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 30px rgba(99, 102, 241, 0.6);
}

.arrow {
    transition: transform 0.3s ease;
}

.btn-primary:hover .arrow {
    transform: translateX(4px);
}

.btn-secondary {
    background: transparent;
    color: #cbd5e1;
    border: 2px solid rgba(255, 255, 255, 0.2);
}

.btn-secondary:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: rgba(255, 255, 255, 0.4);
    color: white;
}

.btn-whatsapp {
    background: linear-gradient(135deg, #25D366, #128C7E);
    color: white;
    box-shadow: 0 4px 20px rgba(37, 211, 102, 0.3);
}

.btn-whatsapp:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 30px rgba(37, 211, 102, 0.5);
}

.whatsapp-icon {
    font-size: 1.2rem;
}

/* Trust badge moderne */
.trust {
    margin-top: 40px;
    padding: 16px 24px;
    background: rgba(255, 255, 255, 0.03);
    border-radius: 12px;
    border-left: 4px solid #6366f1;
    font-size: 0.95rem;
    color: #94a3b8;
    display: flex;
    align-items: flex-start;
    gap: 12px;
    text-align: left;
    max-width: 560px;
    margin-left: auto;
    margin-right: auto;
}

.trust-icon {
    font-size: 1.2rem;
    flex-shrink: 0;
}

/* Responsive */
@media (max-width: 640px) {
    .hero h1 {
        font-size: 2.5rem;
    }
    
    .input-group {
        flex-direction: column;
    }
    
    .input-email {
        width: 100%;
    }
    
    .btn {
        width: 100%;
        justify-content: center;
    }
}
/* Boîte de prix */
.price-box {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    padding: 24px;
    margin: 24px 0;
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.price-main, .price-recurrent {
    display: flex;
    align-items: baseline;
    justify-content: center;
    gap: 12px;
    flex-wrap: wrap;
}

.price-value {
    font-size: 2rem;
    font-weight: 800;
    color: #fbbf24;
    text-shadow: 0 2px 10px rgba(251, 191, 36, 0.3);
}

.price-recurrent .price-value {
    font-size: 1.5rem;
    color: #34d399;
}

.price-label {
    font-size: 0.95rem;
    color: rgba(255, 255, 255, 0.9);
    font-weight: 500;
}

/* Boîte modularité */
.modular-box {
    background: linear-gradient(135deg, rgba(99, 102, 241, 0.2), rgba(139, 92, 246, 0.2));
    border: 1px solid rgba(139, 92, 246, 0.3);
    border-radius: 16px;
    padding: 20px;
    margin: 24px 0;
    display: flex;
    gap: 16px;
    align-items: flex-start;
    text-align: left;
}

.modular-icon {
    font-size: 2rem;
    flex-shrink: 0;
}

.modular-content h3 {
    font-size: 1.1rem;
    font-weight: 700;
    color: white;
    margin-bottom: 8px;
}

.modular-content p {
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.85);
    line-height: 1.5;
    margin-bottom: 12px;
}

.modular-options {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.modular-option {
    background: rgba(255, 255, 255, 0.15);
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    color: white;
    border: 1px solid rgba(255, 255, 255, 0.2);
}
/* Section Promotion */
.promo-box {
    background: linear-gradient(135deg, var(--school-primary, #1a5f2a) 0%, var(--school-secondary, #2d8a4e) 100%);
    border-radius: 16px;
    padding: 24px;
    margin: 24px 0;
    color: white;
    display: flex;
    gap: 16px;
    align-items: flex-start;
    box-shadow: 0 8px 32px rgba(26, 95, 42, 0.3);
    border: 2px solid rgba(255,255,255,0.2);
    position: relative;
    overflow: hidden;
}

.promo-box::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    animation: pulse 3s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); opacity: 0.5; }
    50% { transform: scale(1.1); opacity: 0.8; }
}

.promo-badge {
    font-size: 2.5rem;
    animation: bounce 2s infinite;
    z-index: 1;
}

@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

.promo-content {
    flex: 1;
    z-index: 1;
}

.promo-title {
    font-size: 1.4rem;
    font-weight: 700;
    margin-bottom: 8px;
    text-shadow: 0 2px 4px rgba(0,0,0,0.2);
}

.promo-desc {
    font-size: 0.95rem;
    opacity: 0.95;
    margin-bottom: 12px;
    line-height: 1.5;
}

.promo-features {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 16px;
}

.promo-feature {
    background: rgba(255,255,255,0.2);
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 500;
    backdrop-filter: blur(10px);
}

.promo-cta {
    margin-top: 8px;
}

.promo-highlight {
    background: #ff6b35;
    color: white;
    padding: 10px 20px;
    border-radius: 25px;
    font-weight: 700;
    font-size: 0.9rem;
    display: inline-block;
    box-shadow: 0 4px 15px rgba(255,107,53,0.4);
    animation: glow 2s ease-in-out infinite alternate;
}

@keyframes glow {
    from { box-shadow: 0 4px 15px rgba(255,107,53,0.4); }
    to { box-shadow: 0 4px 25px rgba(255,107,53,0.7); }
}

/* Responsive */
@media (max-width: 768px) {
    .promo-box {
        flex-direction: column;
        text-align: center;
    }
    .promo-features {
        justify-content: center;
    }
}

/* ============================================
   BOUTON SOUSCRIPTION ÉCOLE
   ============================================ */

.suscripcion-box {
    margin: 32px 0;
}

.suscripcion-divider {
    position: relative;
    text-align: center;
    margin-bottom: 20px;
}

.suscripcion-divider::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
}

.suscripcion-divider span {
    position: relative;
    background: rgba(15, 23, 42, 0.9);
    padding: 0 16px;
    color: #94a3b8;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.btn-suscripcion {
    display: flex;
    align-items: center;
    gap: 16px;
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 50%, #b45309 100%);
    border: 2px solid rgba(251, 191, 36, 0.4);
    border-radius: 16px;
    padding: 20px 28px;
    text-decoration: none;
    color: white;
    transition: all 0.3s ease;
    box-shadow: 0 8px 32px rgba(245, 158, 11, 0.3);
    position: relative;
    overflow: hidden;
}

.btn-suscripcion::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s ease;
}

.btn-suscripcion:hover::before {
    left: 100%;
}

.btn-suscripcion:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 40px rgba(245, 158, 11, 0.4);
    border-color: rgba(251, 191, 36, 0.6);
}

.suscripcion-icon {
    font-size: 2.5rem;
    flex-shrink: 0;
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
}

.suscripcion-text {
    flex: 1;
    text-align: left;
    display: flex;
    flex-direction: column;
}

.suscripcion-main {
    font-size: 1.25rem;
    font-weight: 700;
    text-shadow: 0 2px 4px rgba(0,0,0,0.2);
}

.suscripcion-sub {
    font-size: 0.9rem;
    opacity: 0.95;
    font-weight: 500;
}

.suscripcion-arrow {
    font-size: 1.5rem;
    transition: transform 0.3s ease;
}

.btn-suscripcion:hover .suscripcion-arrow {
    transform: translateX(6px);
}

/* Animation pulse pour attirer l'attention */
.btn-suscripcion {
    animation: suscripcionPulse 2s ease-in-out infinite;
}

@keyframes suscripcionPulse {
    0%, 100% { 
        box-shadow: 0 8px 32px rgba(245, 158, 11, 0.3);
    }
    50% { 
        box-shadow: 0 8px 40px rgba(245, 158, 11, 0.5);
    }
}

/* Responsive */
@media (max-width: 640px) {
    .btn-suscripcion {
        flex-direction: column;
        text-align: center;
        gap: 12px;
        padding: 20px;
    }
    
    .suscripcion-text {
        text-align: center;
    }
    
    .suscripcion-icon {
        font-size: 2rem;
    }
    
    .suscripcion-main {
        font-size: 1.1rem;
    }
    
    .suscripcion-arrow {
        display: none;
    }
}