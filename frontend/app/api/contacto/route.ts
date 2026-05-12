import { Resend } from 'resend';
import { NextRequest, NextResponse } from 'next/server';

export async function POST(req: NextRequest) {
  const resend = new Resend(process.env.RESEND_API_KEY);

  const { nombre, email, asunto, mensaje } = await req.json();

  if (!nombre || !email || !mensaje) {
    return NextResponse.json({ error: 'Faltan campos requeridos.' }, { status: 400 });
  }

  const { data, error } = await resend.emails.send({
    from: 'Contacto Colegio N°59 <onboarding@resend.dev>',
    to: 'soflitx4600@gmail.com',
    replyTo: email,
    subject: `[Contacto Web] ${asunto} — ${nombre}`,
    html: `
      <div style="font-family:sans-serif;max-width:600px;margin:0 auto;color:#181c1e">
        <div style="background:#002045;padding:24px 32px;border-radius:12px 12px 0 0">
          <h2 style="color:#fed65b;margin:0;font-size:20px">Nuevo mensaje de contacto</h2>
          <p style="color:#86a0cd;margin:4px 0 0;font-size:13px">Colegio Secundario N°59 "Olga Márquez de Aredez"</p>
        </div>
        <div style="background:#f7fafc;padding:32px;border-radius:0 0 12px 12px;border:1px solid #e5e9eb">
          <table style="width:100%;border-collapse:collapse">
            <tr><td style="padding:8px 0;color:#43474e;font-size:13px;width:120px"><strong>Nombre:</strong></td><td style="padding:8px 0;font-size:14px">${nombre}</td></tr>
            <tr><td style="padding:8px 0;color:#43474e;font-size:13px"><strong>Email:</strong></td><td style="padding:8px 0;font-size:14px"><a href="mailto:${email}" style="color:#1a365d">${email}</a></td></tr>
            <tr><td style="padding:8px 0;color:#43474e;font-size:13px"><strong>Asunto:</strong></td><td style="padding:8px 0;font-size:14px">${asunto}</td></tr>
          </table>
          <hr style="border:none;border-top:1px solid #e5e9eb;margin:20px 0"/>
          <p style="color:#43474e;font-size:13px;margin:0 0 8px"><strong>Mensaje:</strong></p>
          <p style="background:white;padding:16px;border-radius:8px;border:1px solid #e5e9eb;font-size:14px;line-height:1.6;margin:0">${mensaje.replace(/\n/g, '<br/>')}</p>
        </div>
      </div>
    `,
  });

  if (error) {
    console.error('Resend error:', JSON.stringify(error));
    return NextResponse.json({ error: error.message }, { status: 500 });
  }

  console.log('Resend ok:', data);
  return NextResponse.json({ ok: true });
}
