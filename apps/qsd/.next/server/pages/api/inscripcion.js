"use strict";(()=>{var e={};e.id=408,e.ids=[408],e.modules={145:e=>{e.exports=require("next/dist/compiled/next-server/pages-api.runtime.prod.js")},184:e=>{e.exports=require("nodemailer")},900:e=>{e.exports=require("pg")},249:(e,t)=>{Object.defineProperty(t,"l",{enumerable:!0,get:function(){return function e(t,o){return o in t?t[o]:"then"in t&&"function"==typeof t.then?t.then(t=>e(t,o)):"function"==typeof t&&"default"===o?t:void 0}}})},324:(e,t,o)=>{o.r(t),o.d(t,{config:()=>x,default:()=>g,routeModule:()=>b});var d={};o.r(d),o.d(d,{default:()=>c});var i=o(802),r=o(153),n=o(249);let{Pool:a}=o(900),l=o(184),s=new a({connectionString:process.env.DATABASE_URL,ssl:!1}),p=()=>l.createTransport({service:"gmail",auth:{user:process.env.EMAIL_USER,pass:process.env.EMAIL_PASSWORD}});async function c(e,t){if("POST"!==e.method)return t.status(405).json({error:"Method not allowed"});try{let{ac1_nombres:o,ac1_apellido1:d,ac1_apellido2:i,ac1_direccion:r,ac1_ciudad:n,ac1_pais:a,ac1_profesion:l,ac1_empresa:c,ac1_prefijo:g,ac1_telefono:x,ac1_email:b,ac1_parentesco:u,ac2_nombres:f,ac2_apellido1:m,ac2_apellido2:$,ac2_direccion:y,ac2_ciudad:h,ac2_pais:_,ac2_profesion:v,ac2_empresa:w,ac2_prefijo:E,ac2_telefono:A,ac2_email:P,ac2_parentesco:R,est_nombres:I,est_apellido1:S,est_apellido2:N,est_tipo_doc:T,est_numero_doc:M,est_fecha_nac:j,est_lugar_nac:G,est_grado:L,est_antiguo_colegio:O,est_antiguo_direccion:U,est_antiguo_telefono:k,est_motivo_retiro:q,lang:z,schoolId:C}=e.body;if(!o||!d||!r||!n||!x||!b||!u||!I||!S||!M||!j||!L)return t.status(400).json({error:"Campos requeridos faltantes"});if(!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(b))return t.status(400).json({error:"Email inv\xe1lido"});let D=`${o} ${d} ${i||""}`.trim(),F=f?`${f} ${m||""} ${$||""}`.trim():null,W=`${I} ${S} ${N||""}`.trim(),H=`${g||"+57"} ${x}`,B=A&&E?`${E} ${A}`:A||null,V=await s.query("SELECT nombre, email_director FROM schools WHERE id = $1",[C||1]),Y=V.rows[0]?.nombre||"Colegio",J=V.rows[0]?.email_director,K=`
      INSERT INTO inscripciones_estudiantes (
        school_id,
        nombre_estudiante,
        fecha_nacimiento,
        grado,
        tipo_documento,
        numero_documento,
        lugar_nacimiento,
        colegio_procedencia,
        direccion_colegio_anterior,
        telefono_colegio_anterior,
        motivo_retiro,
        nombre_acudiente1,
        email_acudiente1,
        telefono_acudiente1,
        parentesco_acudiente1,
        profesion_acudiente1,
        empresa_acudiente1,
        direccion_acudiente1,
        ciudad_acudiente1,
        pais_acudiente1,
        nombre_acudiente2,
        email_acudiente2,
        telefono_acudiente2,
        parentesco_acudiente2,
        profesion_acudiente2,
        empresa_acudiente2,
        direccion_acudiente2,
        ciudad_acudiente2,
        pais_acudiente2,
        idioma_preferido,
        estado,
        created_at
      ) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13, $14, $15, $16, $17, $18, $19, $20, $21, $22, $23, $24, $25, $26, $27, $28, $29, $30, 'pendiente', NOW())
      RETURNING id
    `,Q=[C||1,W,j,L,T||"RC",M,G||null,O||null,U||null,k||null,q||null,D,b,H,u,l||null,c||null,r,n,a||"CO",F,P||null,B,R||null,v||null,w||null,y||null,h||null,_||null,z||"es"],X=(await s.query(K,Q)).rows[0].id;try{let e=p(),t={from:`"${Y}" <${process.env.EMAIL_USER}>`,to:b,subject:`✅ Inscripci\xf3n Recibida - ${Y}`,html:`
          <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 20px;">
            <div style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 10px 40px rgba(0,0,0,0.1);">
              <div style="text-align: center; margin-bottom: 30px;">
                <div style="font-size: 60px; margin-bottom: 10px;">🎓</div>
                <h1 style="color: #1e293b; margin: 0; font-size: 28px;">\xa1Inscripci\xf3n Recibida!</h1>
              </div>
              
              <p style="color: #64748b; font-size: 16px; line-height: 1.6;">
                Estimado/a <strong>${D}</strong>,
              </p>
              
              <p style="color: #64748b; font-size: 16px; line-height: 1.6;">
                Hemos recibido correctamente la inscripci\xf3n de <strong>${W}</strong> en ${Y}.
              </p>
              
              <div style="background: #f0fdf4; border-left: 4px solid #22c55e; padding: 15px; margin: 20px 0; border-radius: 8px;">
                <p style="margin: 0; color: #166534; font-weight: 600;">
                  📋 N\xfamero de inscripci\xf3n: #${X}
                </p>
              </div>
              
              <h3 style="color: #1e293b; margin-top: 25px;">Resumen de la inscripci\xf3n:</h3>
              <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
                <tr>
                  <td style="padding: 10px; border-bottom: 1px solid #e5e7eb; color: #6b7280;">Estudiante:</td>
                  <td style="padding: 10px; border-bottom: 1px solid #e5e7eb; color: #1e293b; font-weight: 600;">${W}</td>
                </tr>
                <tr>
                  <td style="padding: 10px; border-bottom: 1px solid #e5e7eb; color: #6b7280;">Grado:</td>
                  <td style="padding: 10px; border-bottom: 1px solid #e5e7eb; color: #1e293b; font-weight: 600;">${L}</td>
                </tr>
                <tr>
                  <td style="padding: 10px; border-bottom: 1px solid #e5e7eb; color: #6b7280;">Documento:</td>
                  <td style="padding: 10px; border-bottom: 1px solid #e5e7eb; color: #1e293b; font-weight: 600;">${T} ${M}</td>
                </tr>
                <tr>
                  <td style="padding: 10px; color: #6b7280;">Tel\xe9fono:</td>
                  <td style="padding: 10px; color: #1e293b; font-weight: 600;">${H}</td>
                </tr>
              </table>
              
              <p style="color: #64748b; font-size: 14px; margin-top: 25px; padding-top: 20px; border-top: 1px solid #e5e7eb;">
                Nos pondremos en contacto con usted pr\xf3ximamente para continuar con el proceso de inscripci\xf3n.
              </p>
              
              <div style="text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #e5e7eb;">
                <p style="color: #9ca3af; font-size: 12px; margin: 0;">
                  \xa9 ${new Date().getFullYear()} ${Y} - Todos los derechos reservados
                </p>
              </div>
            </div>
          </div>
        `},o={from:`"${Y}" <${process.env.EMAIL_USER}>`,to:J||process.env.EMAIL_USER,subject:`🎓 Nueva Inscripci\xf3n #${X} - ${W}`,html:`
          <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px;">
            <div style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); border: 1px solid #e5e7eb;">
              <h2 style="color: #1e293b; margin-top: 0;">🎓 Nueva Inscripci\xf3n Recibida</h2>
              
              <div style="background: #eff6ff; padding: 15px; border-radius: 10px; margin: 20px 0;">
                <p style="margin: 0; color: #1e40af; font-size: 18px; font-weight: 600;">
                  Inscripci\xf3n #${X}
                </p>
              </div>
              
              <h3 style="color: #374151; border-bottom: 2px solid #e5e7eb; padding-bottom: 10px;">Datos del Estudiante</h3>
              <table style="width: 100%; margin-bottom: 20px;">
                <tr><td style="padding: 8px; color: #6b7280;">Nombre:</td><td style="padding: 8px; font-weight: 600;">${W}</td></tr>
                <tr><td style="padding: 8px; color: #6b7280;">Documento:</td><td style="padding: 8px; font-weight: 600;">${T} ${M}</td></tr>
                <tr><td style="padding: 8px; color: #6b7280;">Fecha Nac.:</td><td style="padding: 8px; font-weight: 600;">${j}</td></tr>
                <tr><td style="padding: 8px; color: #6b7280;">Grado:</td><td style="padding: 8px; font-weight: 600;">${L}</td></tr>
                ${G?`<tr><td style="padding: 8px; color: #6b7280;">Lugar Nac.:</td><td style="padding: 8px; font-weight: 600;">${G}</td></tr>`:""}
                ${O?`<tr><td style="padding: 8px; color: #6b7280;">Colegio Anterior:</td><td style="padding: 8px; font-weight: 600;">${O}</td></tr>`:""}
              </table>
              
              <h3 style="color: #374151; border-bottom: 2px solid #e5e7eb; padding-bottom: 10px;">Acudiente Principal</h3>
              <table style="width: 100%; margin-bottom: 20px;">
                <tr><td style="padding: 8px; color: #6b7280;">Nombre:</td><td style="padding: 8px; font-weight: 600;">${D}</td></tr>
                <tr><td style="padding: 8px; color: #6b7280;">Parentesco:</td><td style="padding: 8px; font-weight: 600;">${u}</td></tr>
                <tr><td style="padding: 8px; color: #6b7280;">Email:</td><td style="padding: 8px; font-weight: 600;">${b}</td></tr>
                <tr><td style="padding: 8px; color: #6b7280;">Tel\xe9fono:</td><td style="padding: 8px; font-weight: 600;">${H}</td></tr>
                <tr><td style="padding: 8px; color: #6b7280;">Direcci\xf3n:</td><td style="padding: 8px; font-weight: 600;">${r}, ${n}</td></tr>
                ${l?`<tr><td style="padding: 8px; color: #6b7280;">Profesi\xf3n:</td><td style="padding: 8px; font-weight: 600;">${l}</td></tr>`:""}
                ${c?`<tr><td style="padding: 8px; color: #6b7280;">Empresa:</td><td style="padding: 8px; font-weight: 600;">${c}</td></tr>`:""}
              </table>
              
              ${F?`
              <h3 style="color: #374151; border-bottom: 2px solid #e5e7eb; padding-bottom: 10px;">Acudiente 2</h3>
              <table style="width: 100%; margin-bottom: 20px;">
                <tr><td style="padding: 8px; color: #6b7280;">Nombre:</td><td style="padding: 8px; font-weight: 600;">${F}</td></tr>
                ${R?`<tr><td style="padding: 8px; color: #6b7280;">Parentesco:</td><td style="padding: 8px; font-weight: 600;">${R}</td></tr>`:""}
                ${P?`<tr><td style="padding: 8px; color: #6b7280;">Email:</td><td style="padding: 8px; font-weight: 600;">${P}</td></tr>`:""}
                ${B?`<tr><td style="padding: 8px; color: #6b7280;">Tel\xe9fono:</td><td style="padding: 8px; font-weight: 600;">${B}</td></tr>`:""}
              </table>
              `:""}
              
              <div style="background: #fef3c7; border-left: 4px solid #f59e0b; padding: 15px; margin-top: 20px; border-radius: 8px;">
                <p style="margin: 0; color: #92400e;">
                  <strong>⚠️ Acci\xf3n requerida:</strong> Revisar y contactar al acudiente para continuar con el proceso de inscripci\xf3n.
                </p>
              </div>
            </div>
          </div>
        `};await e.sendMail(t),console.log("Email de confirmaci\xf3n enviado a:",b),(J||process.env.EMAIL_USER)&&(await e.sendMail(o),console.log("Email de notificaci\xf3n enviado al director"))}catch(e){console.error("Error enviando emails:",e)}t.status(200).json({success:!0,message:"Inscripci\xf3n registrada correctamente",inscripcionId:X})}catch(e){console.error("Error al guardar inscripci\xf3n:",e),t.status(500).json({error:"Error al procesar la inscripci\xf3n",details:e.message})}}let g=(0,n.l)(d,"default"),x=(0,n.l)(d,"config"),b=new i.PagesAPIRouteModule({definition:{kind:r.x.PAGES_API,page:"/api/inscripcion",pathname:"/api/inscripcion",bundlePath:"",filename:""},userland:d})},153:(e,t)=>{var o;Object.defineProperty(t,"x",{enumerable:!0,get:function(){return o}}),function(e){e.PAGES="PAGES",e.PAGES_API="PAGES_API",e.APP_PAGE="APP_PAGE",e.APP_ROUTE="APP_ROUTE"}(o||(o={}))},802:(e,t,o)=>{e.exports=o(145)}};var t=require("../../webpack-api-runtime.js");t.C(e);var o=t(t.s=324);module.exports=o})();