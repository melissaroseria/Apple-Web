<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>Mesajlar</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=SF+Pro+Display:wght@400;600;700&display=swap" rel="stylesheet">
<style>
* { margin:0; padding:0; box-sizing:border-box; -webkit-tap-highlight-color:transparent; }

:root {
  --blue:#007AFF; --blue-dark:#0060DF; --blue-glow:rgba(0,122,255,0.25);
  --green:#30D158; --red:#FF453A;
  --gray:#3A3A3C; --gray2:#636366; --gray3:#48484A;
  --bg:#000; --bg2:#1C1C1E; --bg3:#2C2C2E; --bg4:#3A3A3C;
  --text:#FFF; --subtext:#8E8E93;
  --border:rgba(255,255,255,0.08); --border2:rgba(255,255,255,0.12);
  --bubble-in:#2C2C2E; --bubble-out:#007AFF;
  --safe-top:env(safe-area-inset-top,44px);
  --safe-bottom:env(safe-area-inset-bottom,34px);
}

html,body { height:100%; background:var(--bg); color:var(--text);
  font-family:-apple-system,'SF Pro Display',BlinkMacSystemFont,sans-serif;
  overflow:hidden; user-select:none; }

/* ─ SCREENS ─ */
.screen { position:absolute; inset:0; display:flex; flex-direction:column;
  transition:transform .38s cubic-bezier(.4,0,.2,1), opacity .38s ease; }
.screen.hidden-right { transform:translateX(100%); opacity:0; pointer-events:none; }
.screen.hidden-left  { transform:translateX(-30%);  opacity:0; pointer-events:none; }

/* ─ HEADERS ─ */
.header { flex-shrink:0; background:rgba(0,0,0,.76);
  backdrop-filter:saturate(180%) blur(20px); -webkit-backdrop-filter:saturate(180%) blur(20px);
  border-bottom:.5px solid var(--border); z-index:10; }

/* ─ LIST SCREEN ─ */
#list-screen .header { padding:calc(var(--safe-top) + 8px) 16px 12px; }
#list-screen .header-top { display:flex; justify-content:space-between; align-items:center; }
.header-settings-btn { display:flex; align-items:center; gap:5px; color:var(--blue);
  font-size:16px; cursor:pointer; min-width:70px; }
.header-settings-btn svg { width:18px; height:18px; }
#list-screen h1 { font-size:34px; font-weight:700; letter-spacing:-.5px; }
.compose-btn { color:var(--blue); cursor:pointer; min-width:70px;
  display:flex; align-items:center; justify-content:flex-end; }
.compose-btn svg { width:22px; height:22px; }

/* Search */
.search-wrap { padding:8px 16px 10px; }
.search-bar { background:var(--bg3); border-radius:10px;
  display:flex; align-items:center; gap:6px; padding:8px 12px;
  color:var(--subtext); font-size:17px; }

/* Msg list */
.msg-list { flex:1; overflow-y:auto; -webkit-overflow-scrolling:touch; }
.msg-list::-webkit-scrollbar { display:none; }

.msg-item { display:flex; align-items:center; padding:10px 16px; gap:14px;
  border-bottom:.5px solid var(--border); cursor:pointer; transition:background .15s; position:relative; }
.msg-item:active { background:rgba(255,255,255,.05); }
.msg-item.unread .contact-name { font-weight:700; }
.msg-item.unread .last-msg { color:var(--text); }

.avatar { width:52px; height:52px; border-radius:50%;
  background:linear-gradient(145deg,#5e5ce6,#bf5af2);
  display:flex; align-items:center; justify-content:center;
  font-size:21px; font-weight:600; color:#fff; flex-shrink:0; overflow:hidden; }
.avatar.green  { background:linear-gradient(145deg,#32d74b,#30db5b); }
.avatar.orange { background:linear-gradient(145deg,#ff9f0a,#ffcc00); }
.avatar.pink   { background:linear-gradient(145deg,#ff375f,#ff6b9d); }
.avatar.blue   { background:linear-gradient(145deg,#0a84ff,#5e5ce6); }
.avatar.teal   { background:linear-gradient(145deg,#5ac8fa,#32ade6); }

.unread-dot { position:absolute; left:4px; top:50%; transform:translateY(-50%);
  width:9px; height:9px; border-radius:50%; background:var(--blue); }

.item-body { flex:1; min-width:0; }
.item-top { display:flex; justify-content:space-between; align-items:baseline; margin-bottom:3px; }
.contact-name { font-size:17px; font-weight:500; }
.ts { color:var(--subtext); font-size:14px; display:flex; align-items:center; gap:3px; }
.last-msg { color:var(--subtext); font-size:15px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }

/* ─ SETTINGS SCREEN ─ */
#settings-screen { background:var(--bg); z-index:50; }
#settings-screen .header { padding:calc(var(--safe-top) + 8px) 16px 12px;
  display:flex; align-items:center; justify-content:space-between; }
.settings-done-btn { color:var(--blue); font-size:17px; font-weight:600; cursor:pointer; }
#settings-screen h2 { font-size:17px; font-weight:600; }
#settings-screen .header-spacer { min-width:60px; }

.settings-body { flex:1; overflow-y:auto; padding:24px 16px; }
.settings-body::-webkit-scrollbar { display:none; }

/* Bot token card */
.token-card {
  background:linear-gradient(135deg,#1a1a2e,#16213e,#0f3460);
  border-radius:20px; padding:24px 20px; margin-bottom:24px;
  position:relative; overflow:hidden; border:1px solid rgba(0,122,255,.25);
}
.token-card::before {
  content:''; position:absolute; top:-30px; right:-30px;
  width:120px; height:120px; border-radius:50%;
  background:radial-gradient(circle, rgba(0,122,255,.3), transparent 70%);
}
.token-card::after {
  content:''; position:absolute; bottom:-20px; left:20px;
  width:80px; height:80px; border-radius:50%;
  background:radial-gradient(circle, rgba(94,92,230,.25), transparent 70%);
}
.token-card-icon {
  width:52px; height:52px; border-radius:14px;
  background:linear-gradient(135deg,var(--blue),#5e5ce6);
  display:flex; align-items:center; justify-content:center;
  margin-bottom:14px; position:relative; z-index:1;
  box-shadow:0 6px 20px rgba(0,122,255,.4);
}
.token-card-icon svg { width:28px; height:28px; }
.token-card h3 { font-size:20px; font-weight:700; margin-bottom:4px; position:relative; z-index:1; }
.token-card p  { font-size:14px; color:rgba(255,255,255,.6); margin-bottom:16px; position:relative; z-index:1; line-height:1.5; }

.token-input-wrap { position:relative; z-index:1; }
.token-input-wrap input {
  width:100%; background:rgba(255,255,255,.1); border:1.5px solid rgba(255,255,255,.2);
  border-radius:12px; color:#fff; font-size:15px; padding:12px 44px 12px 14px;
  outline:none; caret-color:var(--blue); transition:border-color .2s;
  -webkit-text-security:disc; /* password style by default */
}
.token-input-wrap input:focus { border-color:var(--blue); background:rgba(255,255,255,.15); }
.token-input-wrap input::placeholder { color:rgba(255,255,255,.35); }
.token-eye-btn { position:absolute; right:12px; top:50%; transform:translateY(-50%);
  color:rgba(255,255,255,.5); cursor:pointer; display:flex; }
.token-eye-btn svg { width:20px; height:20px; }

.token-save-btn {
  width:100%; background:linear-gradient(135deg,var(--blue),#5e5ce6);
  color:#fff; border:none; border-radius:12px; padding:14px;
  font-size:16px; font-weight:600; cursor:pointer; margin-top:12px;
  position:relative; z-index:1; transition:opacity .2s;
  box-shadow:0 4px 16px rgba(0,122,255,.35);
}
.token-save-btn:active { opacity:.8; }

/* Status chip */
.token-status { display:flex; align-items:center; gap:6px; font-size:13px;
  margin-top:10px; position:relative; z-index:1; }
.status-dot { width:7px; height:7px; border-radius:50%; background:var(--gray2); flex-shrink:0; }
.status-dot.connected { background:var(--green); box-shadow:0 0 6px var(--green); }
.status-dot.error { background:var(--red); }
.status-text { color:rgba(255,255,255,.6); }

/* Settings sections */
.settings-section { margin-bottom:20px; }
.settings-section-title { font-size:13px; color:var(--subtext); text-transform:uppercase;
  letter-spacing:.5px; margin-bottom:8px; padding-left:4px; }
.settings-group { background:var(--bg2); border-radius:14px; overflow:hidden; }
.settings-row { display:flex; align-items:center; gap:14px; padding:14px 16px;
  border-bottom:.5px solid var(--border); cursor:pointer; transition:background .15s; }
.settings-row:last-child { border-bottom:none; }
.settings-row:active { background:rgba(255,255,255,.05); }
.settings-row-icon { width:32px; height:32px; border-radius:8px;
  display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.settings-row-icon svg { width:18px; height:18px; }
.settings-row-icon.blue  { background:var(--blue); }
.settings-row-icon.red   { background:var(--red); }
.settings-row-icon.green { background:var(--green); }
.settings-row-icon.orange{ background:#ff9f0a; }
.settings-row-content { flex:1; }
.settings-row-label { font-size:16px; color:var(--text); }
.settings-row-sub   { font-size:13px; color:var(--subtext); margin-top:2px; }
.settings-row-arrow { color:var(--gray2); }
.settings-row-arrow svg { width:16px; height:16px; }

/* Bot info card (shown after connect) */
.bot-info-card { display:none; background:var(--bg2); border-radius:14px;
  padding:16px; margin-top:12px; position:relative; z-index:1;
  border:1px solid rgba(48,209,88,.2); }
.bot-info-card.show { display:flex; align-items:center; gap:12px; }
.bot-info-avatar { width:44px; height:44px; border-radius:50%;
  background:linear-gradient(135deg,#32d74b,#30db5b);
  display:flex; align-items:center; justify-content:center;
  font-size:18px; font-weight:700; flex-shrink:0; }
.bot-info-name { font-size:16px; font-weight:600; }
.bot-info-handle { font-size:13px; color:var(--subtext); margin-top:2px; }

/* ─ NEW MSG MODAL ─ */
#new-msg-modal { position:fixed; inset:0; z-index:100; pointer-events:none; }
#new-msg-modal .backdrop { position:absolute; inset:0; background:rgba(0,0,0,.5); opacity:0;
  transition:opacity .3s; backdrop-filter:blur(4px); }
#new-msg-modal .sheet { position:absolute; bottom:0; left:0; right:0;
  background:var(--bg2); border-radius:14px 14px 0 0;
  transform:translateY(100%); transition:transform .38s cubic-bezier(.4,0,.2,1);
  padding-bottom:calc(var(--safe-bottom) + 8px); }
#new-msg-modal.open { pointer-events:all; }
#new-msg-modal.open .backdrop { opacity:1; }
#new-msg-modal.open .sheet { transform:translateY(0); }
.sheet-nav { display:flex; justify-content:space-between; align-items:center;
  padding:16px 16px 12px; border-bottom:.5px solid var(--border); }
.sheet-cancel  { color:var(--blue); font-size:17px; cursor:pointer; }
.sheet-title   { font-size:17px; font-weight:600; }
.sheet-confirm { color:var(--blue); font-size:17px; font-weight:600; cursor:pointer; }
.sheet-input-row { display:flex; align-items:center; padding:14px 16px; gap:10px;
  border-bottom:.5px solid var(--border); }
.sheet-input-row:last-child { border-bottom:none; }
.to-label { color:var(--subtext); font-size:17px; min-width:40px; }
.sheet-input-row input { flex:1; background:transparent; border:none; color:var(--text);
  font-size:17px; outline:none; caret-color:var(--blue); }
.sheet-input-row input::placeholder { color:var(--subtext); }

/* ─ CHAT SCREEN ─ */
#chat-screen .header { padding-top:var(--safe-top); }
.chat-header-inner { display:flex; align-items:center; padding:8px 15px 10px; gap:8px; position:relative; }
.back-btn { display:flex; align-items:center; gap:4px; color:var(--blue);
  font-size:17px; cursor:pointer; z-index:1; }
.back-btn svg { width:18px; height:18px; }
.chat-contact-center { position:absolute; left:50%; top:50%;
  transform:translate(-50%,-50%); display:flex; flex-direction:column;
  align-items:center; cursor:pointer; }
.mini-avatar { width:34px; height:34px; border-radius:50%;
  background:linear-gradient(145deg,#5e5ce6,#bf5af2);
  display:flex; align-items:center; justify-content:center;
  font-size:10px; font-weight:500; color:#fff; margin-bottom:2px; }
.mini-avatar.green  { background:linear-gradient(145deg,#32d74b,#30db5b); }
.mini-avatar.orange { background:linear-gradient(145deg,#ff9f0a,#ffcc00); }
.mini-avatar.pink   { background:linear-gradient(145deg,#ff375f,#ff6b9d); }
.mini-avatar.blue   { background:linear-gradient(145deg,#0a84ff,#5e5ce6); }
.mini-avatar.teal   { background:linear-gradient(145deg,#5ac8fa,#32ade6); }
.chat-name-label { font-size:10px; font-weight:500; }
.live-indicator { margin-left:auto; display:flex; align-items:center; gap:5px;
  font-size:12px; color:var(--green); z-index:1; }
.live-dot { width:6px; height:6px; border-radius:50%; background:var(--green);
  animation:livePulse 2s ease-in-out infinite; }
@keyframes livePulse { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:.4;transform:scale(.8)} }

/* Chat box */
#chat-box { flex:1; overflow-y:auto; padding:12px 14px;
  display:flex; flex-direction:column; gap:3px; -webkit-overflow-scrolling:touch; }
#chat-box::-webkit-scrollbar { display:none; }
@media(min-width:600px){
  #chat-box::-webkit-scrollbar { display:block; width:3px; }
  #chat-box::-webkit-scrollbar-thumb { background:var(--gray); border-radius:2px; }
}

.date-divider { text-align:center; color:var(--subtext); font-size:12px;
  margin:10px 0 6px; font-weight:500; }

/* Bubbles */
.bubble-row { display:flex; align-items:flex-end; gap:7px;
  animation:bubblePop .22s cubic-bezier(.34,1.56,.64,1) forwards; }
@keyframes bubblePop { from{transform:scale(.88) translateY(6px);opacity:0} to{transform:scale(1) translateY(0);opacity:1} }
.bubble-row.out { flex-direction:row-reverse; }

.bubble-avatar { width:26px; height:26px; border-radius:50%;
  background:linear-gradient(145deg,#5e5ce6,#bf5af2);
  display:flex; align-items:center; justify-content:center;
  font-size:11px; font-weight:600; color:#fff; flex-shrink:0; margin-bottom:2px; }
.bubble-avatar.green  { background:linear-gradient(145deg,#32d74b,#30db5b); }
.bubble-avatar.orange { background:linear-gradient(145deg,#ff9f0a,#ffcc00); }
.bubble-avatar.pink   { background:linear-gradient(145deg,#ff375f,#ff6b9d); }
.bubble-avatar.blue   { background:linear-gradient(145deg,#0a84ff,#5e5ce6); }
.bubble-avatar.teal   { background:linear-gradient(145deg,#5ac8fa,#32ade6); }
.bubble-avatar.hidden { visibility:hidden; }

.bubble { max-width:88%; min-width:60px; padding:10px 14px; font-size:16px; line-height:1.5; word-break:break-word; }
.bubble-row.in  .bubble { background:var(--bubble-in); color:var(--text); border-radius:18px 18px 18px 4px; }
.bubble-row.out .bubble { background:var(--bubble-out); color:#fff; border-radius:18px 18px 4px 18px; }
.bubble-row.in.consecutive  .bubble { border-radius:4px 18px 18px 4px; }
.bubble-row.out.consecutive .bubble { border-radius:18px 4px 4px 18px; }

/* ── MEDIA BUBBLES ── */
.media-bubble { padding:2px !important; cursor:pointer; max-width:300px; overflow:hidden;
  border:none !important; outline:none !important; }
.media-bubble img { width:100%; border-radius:14px; display:block; max-height:320px; object-fit:cover;
  border:none; outline:none; }
.media-bubble video { width:100%; border-radius:14px; display:block; max-height:320px; border:none; }
.bubble-row.in .media-bubble { background:transparent !important; }
.bubble-row.out .media-bubble { background:transparent !important; }
.media-bubble.sticker { background:transparent !important; }
.media-bubble.sticker img { border-radius:0; max-width:180px; max-height:180px;
  width:auto; height:auto; object-fit:contain; }

/* File bubble */
.file-bubble {
  display:flex; align-items:center; gap:12px;
  background:var(--bubble-in); border-radius:16px; padding:12px 14px;
  cursor:pointer; transition:background .15s; max-width:300px;
}
.file-bubble:active { background:var(--bg4); }
.bubble-row.out .file-bubble { background:rgba(255,255,255,.18); }
.file-icon { width:40px; height:40px; border-radius:10px;
  background:rgba(0,122,255,.2); display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.file-icon svg { width:22px; height:22px; color:var(--blue); }
.bubble-row.out .file-icon { background:rgba(255,255,255,.2); }
.bubble-row.out .file-icon svg { color:#fff; }
.file-info { flex:1; min-width:0; }
.file-name { font-size:14px; font-weight:600; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }
.file-size { font-size:12px; color:var(--subtext); margin-top:2px; }
.bubble-row.out .file-size { color:rgba(255,255,255,.6); }
.download-icon { flex-shrink:0; color:var(--blue); }
.bubble-row.out .download-icon { color:rgba(255,255,255,.8); }
.download-icon svg { width:18px; height:18px; }

/* Audio bubble */
.audio-bubble { display:flex; align-items:center; gap:10px;
  background:var(--bubble-in); border-radius:22px; padding:10px 14px;
  max-width:240px; cursor:pointer; }
.bubble-row.out .audio-bubble { background:rgba(255,255,255,.18); }
.audio-play-btn { width:34px; height:34px; border-radius:50%;
  background:var(--blue); display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.audio-play-btn svg { width:16px; height:16px; fill:#fff; }
.bubble-row.out .audio-play-btn { background:rgba(255,255,255,.25); }
.audio-waveform { flex:1; height:28px; display:flex; align-items:center; gap:2px; }
.audio-waveform span { width:3px; border-radius:2px; background:var(--gray2);
  animation:waveAnim 1s ease-in-out infinite; }
.audio-waveform span:nth-child(1){height:8px; animation-delay:0s}
.audio-waveform span:nth-child(2){height:16px;animation-delay:.1s}
.audio-waveform span:nth-child(3){height:12px;animation-delay:.2s}
.audio-waveform span:nth-child(4){height:20px;animation-delay:.3s}
.audio-waveform span:nth-child(5){height:10px;animation-delay:.4s}
.audio-waveform span:nth-child(6){height:18px;animation-delay:.5s}
.audio-waveform span:nth-child(7){height:8px; animation-delay:.6s}
.audio-waveform span:nth-child(8){height:14px;animation-delay:.7s}
@keyframes waveAnim { 0%,100%{transform:scaleY(.5)} 50%{transform:scaleY(1)} }
.audio-dur { font-size:12px; color:var(--subtext); }
.bubble-row.out .audio-dur { color:rgba(255,255,255,.6); }

/* Image lightbox */
#lightbox { position:fixed; inset:0; background:rgba(0,0,0,.92); z-index:500;
  display:flex; align-items:center; justify-content:center;
  opacity:0; pointer-events:none; transition:opacity .25s; }
#lightbox.open { opacity:1; pointer-events:all; }
#lightbox img,#lightbox video { max-width:95vw; max-height:90vh; border-radius:10px;
  object-fit:contain; }
.lightbox-close { position:absolute; top:calc(var(--safe-top) + 10px); right:16px;
  width:34px; height:34px; border-radius:50%; background:rgba(255,255,255,.15);
  display:flex; align-items:center; justify-content:center; cursor:pointer; }
.lightbox-close svg { width:18px; height:18px; }
.lightbox-dl { position:absolute; bottom:calc(var(--safe-bottom) + 20px); right:20px;
  background:var(--blue); color:#fff; border:none; border-radius:50%;
  width:44px; height:44px; display:flex; align-items:center; justify-content:center;
  cursor:pointer; box-shadow:0 4px 14px rgba(0,122,255,.5); }
.lightbox-dl svg { width:22px; height:22px; }

/* Bubble meta */
.bubble-meta { font-size:11px; color:var(--subtext); margin-top:2px;
  padding:0 3px; display:flex; align-items:center; gap:4px; }
.bubble-row.out .bubble-meta { justify-content:flex-end; }
.check { font-size:11px; }
.check.sent { color:var(--subtext); }
.check.delivered { color:var(--blue); }

/* Typing indicator */
.typing-row { display:flex; align-items:flex-end; gap:7px; }
.typing-bubble { background:var(--bubble-in); border-radius:18px; padding:12px 16px;
  display:flex; gap:5px; align-items:center; }
.typing-bubble span { width:7px; height:7px; background:var(--subtext); border-radius:50%;
  animation:typeBounce 1.2s ease-in-out infinite; }
.typing-bubble span:nth-child(2){animation-delay:.2s}
.typing-bubble span:nth-child(3){animation-delay:.4s}
@keyframes typeBounce { 0%,60%,100%{transform:translateY(0)} 30%{transform:translateY(-5px)} }

/* ─ INPUT BAR ─ */
.input-bar { flex-shrink:0; background:rgba(0,0,0,.76);
  backdrop-filter:saturate(180%) blur(20px); -webkit-backdrop-filter:saturate(180%) blur(20px);
  border-top:.5px solid var(--border); padding:10px 12px;
  padding-bottom:calc(var(--safe-bottom) + 10px);
  display:flex; align-items:flex-end; gap:10px; }

.input-attach-btn { color:var(--blue); cursor:pointer; flex-shrink:0;
  display:flex; align-items:center; padding-bottom:3px; }
.input-attach-btn svg { width:26px; height:26px; }

.input-pill { flex:1; background:var(--bg3); border:1.5px solid var(--gray);
  border-radius:22px; display:flex; align-items:flex-end;
  padding:6px 8px 6px 13px; gap:6px; transition:border-color .2s; }
.input-pill:focus-within { border-color:var(--blue); }

#msg-input { flex:1; background:transparent; border:none; outline:none;
  color:var(--text); font-size:16px; resize:none; max-height:120px;
  overflow-y:auto; caret-color:var(--blue); line-height:1.4; padding:2px 0; font-family:inherit; }
#msg-input::-webkit-scrollbar { display:none; }
#msg-input::placeholder { color:var(--gray2); }

.send-btn { width:28px; height:28px; border-radius:50%; border:none;
  background:var(--blue); display:flex; align-items:center; justify-content:center;
  cursor:pointer; flex-shrink:0; transition:transform .15s, background .15s; margin-bottom:1px; }
.send-btn:active { transform:scale(.88); background:var(--blue-dark); }
.send-btn:disabled { background:var(--gray); cursor:default; }
.send-btn svg { width:15px; height:15px; fill:#fff; }

/* Attach preview */
#attach-preview { display:none; background:var(--bg2); border-top:.5px solid var(--border);
  padding:10px 16px; flex-shrink:0; }
#attach-preview.show { display:flex; align-items:center; gap:12px; }
.attach-thumb { width:56px; height:56px; border-radius:10px; object-fit:cover; background:var(--bg3);
  display:flex; align-items:center; justify-content:center; overflow:hidden; flex-shrink:0; }
.attach-thumb img { width:100%; height:100%; object-fit:cover; border-radius:10px; }
.attach-thumb svg { width:26px; height:26px; color:var(--blue); }
.attach-info { flex:1; min-width:0; }
.attach-info .attach-name { font-size:14px; font-weight:600; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }
.attach-info .attach-type { font-size:12px; color:var(--subtext); margin-top:2px; }
.attach-remove { color:var(--subtext); cursor:pointer; flex-shrink:0; }
.attach-remove svg { width:22px; height:22px; }

/* File input hidden */
#file-input { display:none; }

/* Empty state */
.empty-state { flex:1; display:flex; flex-direction:column; align-items:center;
  justify-content:center; gap:12px; color:var(--subtext); padding:40px; }
.empty-state svg { width:58px; height:58px; opacity:.35; }
.empty-state p { font-size:16px; text-align:center; line-height:1.5; }

/* ─ PROFILE PHOTO AVATAR ─ */
.avatar img, .bubble-avatar img, .mini-avatar img {
  width:100%; height:100%; object-fit:cover; border-radius:50%; display:block; }

/* ─ QUICK REPLY TEMPLATES ─ */
#quick-reply-panel {
  display:none; flex-shrink:0;
  background:rgba(0,0,0,.86);
  backdrop-filter:saturate(180%) blur(20px);
  -webkit-backdrop-filter:saturate(180%) blur(20px);
  border-top:.5px solid var(--border);
  padding:10px 0 10px;
}
#quick-reply-panel.show { display:block; }
.qr-section-title {
  font-size:11px; color:var(--subtext); text-transform:uppercase;
  letter-spacing:.5px; margin-bottom:8px; padding:0 14px;
}
.qr-chips {
  display:flex;
  flex-wrap:nowrap;
  flex-direction:row;
  gap:8px;
  overflow-x:scroll;
  overflow-y:hidden;
  -webkit-overflow-scrolling:touch;
  padding:2px 14px 4px;
  scrollbar-width:none;
  width:100%;
  box-sizing:border-box;
}
.qr-chips::-webkit-scrollbar { display:none; }
.qr-chip {
  flex:0 0 auto;
  display:inline-flex;
  align-items:center;
  background:var(--bg3);
  border:1px solid var(--border2);
  border-radius:20px;
  padding:9px 16px;
  font-size:14.5px;
  color:var(--text);
  cursor:pointer;
  transition:background .15s, transform .1s;
  white-space:nowrap;
  line-height:1.3;
  max-width:240px;
  overflow:hidden;
  text-overflow:ellipsis;
}
.qr-chip:active { background:var(--bg4); transform:scale(.96); }

/* ─ CONTACT DETAIL MODAL ─ */
#contact-modal {
  position:fixed; inset:0; z-index:300;
  pointer-events:none;
}
#contact-modal .cm-backdrop {
  position:absolute; inset:0;
  background:rgba(0,0,0,.6);
  backdrop-filter:blur(6px);
  -webkit-backdrop-filter:blur(6px);
  opacity:0; transition:opacity .3s;
}
#contact-modal .cm-sheet {
  position:absolute; bottom:0; left:0; right:0;
  background:var(--bg2);
  border-radius:20px 20px 0 0;
  transform:translateY(100%);
  transition:transform .4s cubic-bezier(.4,0,.2,1);
  padding-bottom:calc(var(--safe-bottom) + 16px);
  max-height:88vh;
  overflow-y:auto;
}
#contact-modal.open { pointer-events:all; }
#contact-modal.open .cm-backdrop { opacity:1; }
#contact-modal.open .cm-sheet { transform:translateY(0); }

.cm-handle { width:36px; height:4px; background:var(--gray3); border-radius:2px;
  margin:12px auto 0; }
.cm-header { display:flex; justify-content:flex-end; padding:4px 16px 0;  }
.cm-close { color:var(--blue); font-size:16px; font-weight:600; cursor:pointer; padding:8px 0; }

.cm-profile { display:flex; flex-direction:column; align-items:center; padding:8px 20px 24px; }
.cm-avatar-wrap { position:relative; margin-bottom:14px; }
.cm-avatar {
  width:90px; height:90px; border-radius:50%;
  background:linear-gradient(145deg,#5e5ce6,#bf5af2);
  display:flex; align-items:center; justify-content:center;
  font-size:36px; font-weight:700; color:#fff; overflow:hidden;
  box-shadow:0 6px 24px rgba(0,0,0,.4);
}
.cm-avatar img { width:100%; height:100%; object-fit:cover; border-radius:50%; }
.cm-name { font-size:24px; font-weight:700; text-align:center; margin-bottom:4px; }
.cm-handle { font-size:15px; color:var(--subtext); margin-bottom:20px; }

.cm-actions { display:flex; gap:20px; margin-bottom:28px; }
.cm-action {
  display:flex; flex-direction:column; align-items:center; gap:6px;
  cursor:pointer;
}
.cm-action-icon {
  width:52px; height:52px; border-radius:50%;
  background:var(--bg3);
  display:flex; align-items:center; justify-content:center;
  transition:background .15s;
}
.cm-action-icon:active { background:var(--bg4); }
.cm-action-icon svg { width:22px; height:22px; }
.cm-action span { font-size:12px; color:var(--subtext); }

.cm-info-section { width:100%; }
.cm-info-title { font-size:13px; color:var(--subtext); text-transform:uppercase;
  letter-spacing:.5px; margin-bottom:8px; padding:0 4px; }
.cm-info-group { background:var(--bg3); border-radius:14px; overflow:hidden; margin-bottom:20px; }
.cm-info-row { display:flex; align-items:center; padding:14px 16px;
  border-bottom:.5px solid var(--border); gap:12px; }
.cm-info-row:last-child { border-bottom:none; }
.cm-info-icon { width:32px; height:32px; border-radius:8px;
  display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.cm-info-icon svg { width:17px; height:17px; }
.cm-info-icon.blue  { background:var(--blue); }
.cm-info-icon.green { background:var(--green); }
.cm-info-icon.purple{ background:#5e5ce6; }
.cm-info-icon.orange{ background:#ff9f0a; }
.cm-info-content { flex:1; }
.cm-info-label { font-size:12px; color:var(--subtext); margin-bottom:2px; }
.cm-info-value { font-size:16px; color:var(--text); }
.cm-info-value.skeleton {
  background:var(--bg4); border-radius:6px; height:18px; width:140px;
  animation:shimmer 1.4s ease-in-out infinite;
}
@keyframes shimmer {
  0%,100%{opacity:.4} 50%{opacity:.9}
}

.cm-danger-btn {
  width:100%; background:transparent; color:var(--red);
  border:.5px solid rgba(255,69,58,.3); border-radius:14px;
  padding:15px; font-size:16px; font-weight:500; cursor:pointer;
  margin-top:4px; transition:background .15s;
}
.cm-danger-btn:active { background:rgba(255,69,58,.1); }

/* Toast */
.toast { position:fixed; bottom:100px; left:50%; transform:translateX(-50%) translateY(18px);
  background:rgba(44,44,46,.96); backdrop-filter:blur(10px); color:#fff;
  padding:10px 20px; border-radius:30px; font-size:14px; z-index:999;
  opacity:0; transition:all .28s; pointer-events:none; white-space:nowrap; }
.toast.show { opacity:1; transform:translateX(-50%) translateY(0); }
</style>
</head>
<body>

<!-- ══ LIST SCREEN ══ -->
<div class="screen" id="list-screen">
  <div class="header">
    <div class="header-top">
      <span class="header-settings-btn" onclick="openSettingsScreen()">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="3"/>
          <path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/>
        </svg>
        Ayarlar
      </span>
      <h1>Mesajlar</h1>
      <span class="compose-btn" onclick="openNewMsg()">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
          <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
        </svg>
      </span>
    </div>
    <div class="search-wrap">
      <div class="search-bar">
        <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
          <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
        Ara
      </div>
    </div>
  </div>
  <div class="msg-list" id="msg-list">
    <div class="empty-state" id="empty-hint">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
        <path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
      </svg>
      <p>Henüz konuşma yok.<br>Sağ üstteki kalem ikonuna tıkla.</p>
    </div>
  </div>
</div>

<!-- ══ SETTINGS SCREEN ══ -->
<div class="screen hidden-right" id="settings-screen">
  <div class="header">
    <span style="min-width:60px"></span>
    <h2>Ayarlar</h2>
    <span class="settings-done-btn" onclick="closeSettingsScreen()">Bitti</span>
  </div>
  <div class="settings-body">

    <!-- Token Card -->
    <div class="token-card">
      <div class="token-card-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .84h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 8.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/>
        </svg>
      </div>
      <h3>Telegram Bot</h3>
      <p>Botunuzu bağlamak için @BotFather'dan aldığınız token'i girin.</p>

      <div class="token-input-wrap">
        <input type="password" id="s-token" placeholder="1234567890:AAHGjW5BX98hjmGc..." autocomplete="off" spellcheck="false">
        <span class="token-eye-btn" onclick="toggleTokenVis()" id="eye-btn">
          <svg id="eye-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
          </svg>
        </span>
      </div>

      <div class="token-status" id="token-status">
        <div class="status-dot" id="status-dot"></div>
        <span class="status-text" id="status-text">Token girilmedi</span>
      </div>

      <div class="bot-info-card" id="bot-info-card">
        <div class="bot-info-avatar" id="bot-avatar-letter">B</div>
        <div>
          <div class="bot-info-name" id="bot-name-text">Bot</div>
          <div class="bot-info-handle" id="bot-handle-text">@bot</div>
        </div>
      </div>

      <button class="token-save-btn" onclick="saveToken()">Bağlan & Kaydet</button>
    </div>

    <!-- Polling section -->
    <div class="settings-section">
      <div class="settings-section-title">Bağlantı</div>
      <div class="settings-group">
        <div class="settings-row">
          <div class="settings-row-icon green">
            <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round"><polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 11-2.12-9.36L23 10"/></svg>
          </div>
          <div class="settings-row-content">
            <div class="settings-row-label">Otomatik Yenileme</div>
            <div class="settings-row-sub">Her 5 saniyede mesaj kontrol</div>
          </div>
          <div style="color:var(--green);font-size:13px;font-weight:600">Aktif</div>
        </div>
        <div class="settings-row">
          <div class="settings-row-icon blue">
            <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
          </div>
          <div class="settings-row-content">
            <div class="settings-row-label">Medya İndirme</div>
            <div class="settings-row-sub">Fotoğraf, video, dosya</div>
          </div>
          <div style="color:var(--green);font-size:13px;font-weight:600">Aktif</div>
        </div>
      </div>
    </div>

    <!-- Danger zone -->
    <div class="settings-section">
      <div class="settings-section-title">Diğer</div>
      <div class="settings-group">
        <div class="settings-row" onclick="clearAllChats()">
          <div class="settings-row-icon red">
            <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/></svg>
          </div>
          <div class="settings-row-content">
            <div class="settings-row-label" style="color:var(--red)">Tüm Sohbetleri Temizle</div>
            <div class="settings-row-sub">Kayıtlı tüm konuşmaları sil</div>
          </div>
          <div class="settings-row-arrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="9 18 15 12 9 6"/></svg></div>
        </div>
      </div>
    </div>

    <div style="text-align:center;color:var(--subtext);font-size:13px;padding:10px 0 20px">
      iMessage Bot · v2.0 🫠
    </div>
  </div>
</div>

<!-- ══ CHAT SCREEN ══ -->
<div class="screen hidden-right" id="chat-screen">
  <div class="header">
    <div class="chat-header-inner">
      <div class="back-btn" onclick="closeChat()">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
        Geri
      </div>
      <div class="chat-contact-center" onclick="openContactModal()" style="cursor:pointer">
        <div class="mini-avatar" id="chat-mini-avatar">R</div>
        <span class="chat-name-label" id="chat-name-label">—</span>
      </div>
      <div class="live-indicator">
        <div class="live-dot" id="live-dot"></div>
      </div>
    </div>
  </div>

  <div id="chat-box"></div>

  <!-- Quick Reply Templates -->
  <div id="quick-reply-panel">
    <div class="qr-section-title">Hızlı Yanıtlar</div>
    <div class="qr-chips" id="qr-chips"></div>
  </div>

  <!-- Attach preview bar -->
  <div id="attach-preview">
    <div class="attach-thumb" id="attach-thumb-el"></div>
    <div class="attach-info">
      <div class="attach-name" id="attach-name-el">dosya.pdf</div>
      <div class="attach-type" id="attach-type-el">Belge</div>
    </div>
    <span class="attach-remove" onclick="clearAttach()">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
    </span>
  </div>

  <div class="input-bar">
    <label class="input-attach-btn" for="file-input" title="Dosya / Fotoğraf">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10"/>
        <line x1="12" y1="8" x2="12" y2="16"/>
        <line x1="8" y1="12" x2="16" y2="12"/>
      </svg>
    </label>
    <span class="input-attach-btn" onclick="toggleQuickReplies()" title="Şablonlar" id="qr-toggle-btn">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
        <line x1="8" y1="10" x2="16" y2="10"/>
        <line x1="8" y1="14" x2="13" y2="14"/>
      </svg>
    </span>
    <input type="file" id="file-input" accept="image/*,video/*,audio/*,.pdf,.doc,.docx,.zip,.txt" onchange="onFileSelected(event)">
    <div class="input-pill">
      <textarea id="msg-input" rows="1" placeholder="iMessage"></textarea>
      <button class="send-btn" id="send-btn" onclick="sendMessage()" disabled>
        <svg viewBox="0 0 24 24"><path d="M12 19V5M5 12l7-7 7 7"/></svg>
      </button>
    </div>
  </div>
</div>

<!-- ══ NEW MSG MODAL ══ -->
<div id="new-msg-modal">
  <div class="backdrop" onclick="closeNewMsg()"></div>
  <div class="sheet">
    <div class="sheet-nav">
      <span class="sheet-cancel" onclick="closeNewMsg()">Vazgeç</span>
      <span class="sheet-title">Yeni Mesaj</span>
      <span class="sheet-confirm" onclick="startChat()">Aç</span>
    </div>
    <div class="sheet-input-row">
      <span class="to-label">Kime:</span>
      <input type="number" id="new-chat-id" placeholder="Telegram Chat ID" inputmode="numeric">
    </div>
    <div class="sheet-input-row">
      <span class="to-label">İsim:</span>
      <input type="text" id="new-chat-name" placeholder="Görüntülenecek isim">
    </div>
  </div>
</div>

<!-- ══ CONTACT MODAL ══ -->
<div id="contact-modal">
  <div class="cm-backdrop" onclick="closeContactModal()"></div>
  <div class="cm-sheet">
    <div class="cm-handle"></div>
    <div class="cm-header">
      <span class="cm-close" onclick="closeContactModal()">Bitti</span>
    </div>
    <div class="cm-profile">
      <div class="cm-avatar-wrap">
        <div class="cm-avatar" id="cm-avatar">?</div>
      </div>
      <div class="cm-name" id="cm-name">—</div>
      <div class="cm-handle" id="cm-username" style="width:auto;background:transparent;height:auto;border-radius:0;animation:none">—</div>
      <div class="cm-actions">
        <div class="cm-action" onclick="cmSendMsg()">
          <div class="cm-action-icon" style="background:var(--blue)">
            <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round">
              <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
            </svg>
          </div>
          <span>Mesaj</span>
        </div>
        <div class="cm-action" onclick="cmOpenTelegram()">
          <div class="cm-action-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
              <path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/>
            </svg>
          </div>
          <span>Telegram</span>
        </div>
        <div class="cm-action" onclick="cmCopyId()">
          <div class="cm-action-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
              <rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/>
            </svg>
          </div>
          <span>ID Kopyala</span>
        </div>
      </div>

      <div class="cm-info-section">
        <div class="cm-info-title">Bilgiler</div>
        <div class="cm-info-group">
          <div class="cm-info-row">
            <div class="cm-info-icon blue">
              <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round">
                <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/>
              </svg>
            </div>
            <div class="cm-info-content">
              <div class="cm-info-label">Ad Soyad</div>
              <div class="cm-info-value" id="cm-fullname">—</div>
            </div>
          </div>
          <div class="cm-info-row">
            <div class="cm-info-icon purple">
              <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round">
                <path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/>
              </svg>
            </div>
            <div class="cm-info-content">
              <div class="cm-info-label">Kullanıcı Adı</div>
              <div class="cm-info-value" id="cm-uname">—</div>
            </div>
          </div>
          <div class="cm-info-row">
            <div class="cm-info-icon green">
              <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round">
                <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.99 1.18 2 2 0 013 .99h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L7.09 8.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/>
              </svg>
            </div>
            <div class="cm-info-content">
              <div class="cm-info-label">Telefon</div>
              <div class="cm-info-value" id="cm-phone">Gizli / Paylaşılmamış</div>
            </div>
          </div>
          <div class="cm-info-row">
            <div class="cm-info-icon orange">
              <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round">
                <rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/>
              </svg>
            </div>
            <div class="cm-info-content">
              <div class="cm-info-label">Chat ID</div>
              <div class="cm-info-value" id="cm-chatid">—</div>
            </div>
          </div>
          <div class="cm-info-row">
            <div class="cm-info-icon" style="background:var(--gray3)">
              <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round">
                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
              </svg>
            </div>
            <div class="cm-info-content">
              <div class="cm-info-label">Bio</div>
              <div class="cm-info-value" id="cm-bio" style="white-space:pre-wrap;font-size:14px;color:var(--subtext)">—</div>
            </div>
          </div>
        </div>

        <button class="cm-danger-btn" onclick="deleteThisChat()">Bu Sohbeti Sil</button>
      </div>
    </div>
  </div>
</div>

<!-- ══ LIGHTBOX ══ -->
<div id="lightbox" onclick="closeLightbox(event)">
  <div class="lightbox-close" onclick="closeLightbox()">
    <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
  </div>
  <div id="lightbox-content"></div>
  <button class="lightbox-dl" id="lightbox-dl-btn" onclick="lightboxDownload()">
    <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
  </button>
</div>

<div class="toast" id="toast"></div>

<script>
// ═══ QUICK REPLY TEMPLATES ═══
const QUICK_REPLIES = [
  "Merhaba! Nasıl yardımcı olabilirim? 😊",
  "Tamam, anlıyorum. Biraz daha detay verebilir misin?",
  "Şu an müsait değilim, biraz sonra yazarım 🙏",
  "Harika haber! Çok sevindim bunu duyunca 🎉",
  "Tabi ki, hemen hallederim 👍",
  "Özür dilerim, geç gördüm mesajını 🙈",
  "Ne zaman müsaitsin? Biraz konuşalım mı?",
  "Evet kesinlikle, bu konuda seninle aynı fikirdeyim!",
  "Biraz daha açıklar mısın, tam anlamadım?",
  "Merak etme, her şey yoluna girecek ❤️",
  "Şu an biraz meşgulüm, yakında dönerim sana!",
  "Günaydın! Umarım güzel bir gün geçiriyorsundur ☀️",
  "İyi geceler, görüşürüz yarın 🌙",
  "Çok teşekkür ederim, gerçekten çok işe yaradı!",
  "Anlıyorum seni, bu gerçekten zor bir durum 😔",
  "Haha bu çok komikti, güldürdün beni 😂",
  "Evet tabii, linki/fotoğrafı/dosyayı birazdan atıyorum.",
  "Bekle, şu an bir şeye bakıyorum, 5 dk içinde yazarım!",
  "Harika görünüyor, devam et böyle! 💪",
  "Hiç sorun değil, ne zaman istersen yardımcı olurum 😊"
];

let qrVisible = false;

function initQuickReplies() {
  const chips = document.getElementById('qr-chips');
  chips.innerHTML = '';
  QUICK_REPLIES.forEach(text => {
    const chip = document.createElement('div');
    chip.className = 'qr-chip';
    chip.textContent = text;
    chip.onclick = () => {
      document.getElementById('msg-input').value = text;
      const inp = document.getElementById('msg-input');
      inp.style.height = 'auto';
      inp.style.height = Math.min(inp.scrollHeight, 120) + 'px';
      updateSendBtn();
      toggleQuickReplies(false);
      inp.focus();
    };
    chips.appendChild(chip);
  });
}

function toggleQuickReplies(force) {
  const panel = document.getElementById('quick-reply-panel');
  const btn   = document.getElementById('qr-toggle-btn');
  qrVisible = (force !== undefined) ? force : !qrVisible;
  panel.classList.toggle('show', qrVisible);
  btn.style.color = qrVisible ? 'var(--green)' : 'var(--blue)';
}

// ═══ PROFILE PHOTO ═══
const profilePhotoCache = {}; // chatId -> url or 'none'

async function fetchProfilePhoto(chatId) {
  if (profilePhotoCache[chatId] !== undefined) return profilePhotoCache[chatId];
  if (!BOT_TOKEN) return null;
  try {
    const r = await tgAPI('getUserProfilePhotos', { user_id: chatId, limit: 1 });
    if (r.ok && r.result.total_count > 0) {
      const fileId = r.result.photos[0][r.result.photos[0].length-1].file_id;
      const fr = await tgAPI('getFile', { file_id: fileId });
      if (fr.ok) {
        const url = `https://api.telegram.org/file/bot${BOT_TOKEN}/${fr.result.file_path}`;
        profilePhotoCache[chatId] = url;
        return url;
      }
    }
    profilePhotoCache[chatId] = 'none';
  } catch {}
  return null;
}

function avatarHtmlFor(chat, size, extraClass='') {
  const col = COLORS[chats.indexOf(chat) % COLORS.length];
  const letter = (chat.name||'?').charAt(0).toUpperCase();
  if (chat.photoUrl && chat.photoUrl !== 'none') {
    return `<div class="${size} ${extraClass}" style="background:none"><img src="${chat.photoUrl}" alt="${letter}" onerror="this.parentElement.innerHTML='${letter}'"></div>`;
  }
  return `<div class="${size} ${col} ${extraClass}">${letter}</div>`;
}

async function loadAndCachePhoto(c) {
  if (c.photoUrl) return;
  const url = await fetchProfilePhoto(c.id);
  if (url && url !== 'none') {
    c.photoUrl = url;
    saveChats();
  }
}

// ═══ STATE ═══
let BOT_TOKEN  = localStorage.getItem('tg_token') || '';
let chats      = JSON.parse(localStorage.getItem('tg_chats') || '[]');
let activeChat = null;
let pollTimer  = null;
let bgPollTimer= null;
let lastOffset = parseInt(localStorage.getItem('tg_offset') || '0');
let pollActive = false;
let pendingFile= null;
let lightboxUrl= null;

const COLORS = ['', 'green', 'orange', 'pink', 'blue', 'teal'];

// ═══ INIT ═══
document.addEventListener('DOMContentLoaded', () => {
  renderChatList();
  initTokenStatus();
  requestWakeLock();
  if (!BOT_TOKEN) setTimeout(openSettingsScreen, 700);
  else startBgPoll();

  const inp = document.getElementById('msg-input');
  inp.addEventListener('input', () => {
    inp.style.height = 'auto';
    inp.style.height = Math.min(inp.scrollHeight, 120) + 'px';
    updateSendBtn();
  });
  inp.addEventListener('keydown', e => {
    if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); sendMessage(); }
  });
});

function updateSendBtn() {
  const inp = document.getElementById('msg-input');
  document.getElementById('send-btn').disabled = inp.value.trim() === '' && !pendingFile;
}

// ═══ CHAT LIST ═══
function renderChatList() {
  const list = document.getElementById('msg-list');
  const empty = document.getElementById('empty-hint');
  list.querySelectorAll('.msg-item').forEach(el => el.remove());
  if (!chats.length) { empty.style.display='flex'; return; }
  empty.style.display = 'none';

  chats.slice().reverse().forEach((c, ri) => {
    const i = chats.length - 1 - ri;
    const item = document.createElement('div');
    item.className = 'msg-item' + (c.unread ? ' unread' : '');
    const colorClass = COLORS[i % COLORS.length];
    const last = c.messages.length ? c.messages[c.messages.length-1] : null;
    let lastText = 'Konuşma başlat';
    if (last) {
      if (last.type === 'photo')  lastText = (last.out?'📷 Fotoğraf':'📷 Fotoğraf');
      else if (last.type==='video') lastText = '🎥 Video';
      else if (last.type==='audio'||last.type==='voice') lastText = '🎤 Ses';
      else if (last.type==='document') lastText = '📎 ' + (last.fileName||'Dosya');
      else if (last.type==='sticker') lastText = '😄 Sticker';
      else lastText = (last.out ? '✓ ' : '') + (last.text || '');
    }
    const ts = last ? formatTime(last.ts) : '';

    item.innerHTML = `
      ${c.unread ? '<div class="unread-dot"></div>' : ''}
      ${avatarHtmlFor(c, 'avatar', '')}
      <div class="item-body">
        <div class="item-top">
          <span class="contact-name">${esc(c.name)}</span>
          <span class="ts">${ts}<svg viewBox="0 0 24 24" width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="9 18 15 12 9 6"/></svg></span>
        </div>
        <p class="last-msg">${esc(lastText.slice(0,60))}</p>
      </div>`;
    item.onclick = () => openChat(c);
    list.appendChild(item);
  });
}

function saveChats() {
  const slim = chats.map(c => ({ ...c, messages: c.messages.slice(-300) }));
  localStorage.setItem('tg_chats', JSON.stringify(slim));
  localStorage.setItem('tg_offset', String(lastOffset));
}

// ═══ SCREENS NAV ═══
function openSettingsScreen() {
  initTokenStatus();
  document.getElementById('s-token').value = BOT_TOKEN;
  document.getElementById('list-screen').classList.add('hidden-left');
  document.getElementById('settings-screen').classList.remove('hidden-right');
}
function closeSettingsScreen() {
  document.getElementById('settings-screen').classList.add('hidden-right');
  document.getElementById('list-screen').classList.remove('hidden-left');
}

function openChat(c) {
  activeChat = c; c.unread = false; saveChats(); renderChatList();
  const i = chats.indexOf(c);
  const col = COLORS[i % COLORS.length];
  const mini = document.getElementById('chat-mini-avatar');

  // Set avatar — photo or letter
  if (c.photoUrl && c.photoUrl !== 'none') {
    mini.className = 'mini-avatar';
    mini.style.background = 'none';
    mini.innerHTML = `<img src="${c.photoUrl}" style="width:100%;height:100%;object-fit:cover;border-radius:50%;display:block" onerror="this.parentElement.textContent='${c.name.charAt(0).toUpperCase()}'">`;
  } else {
    mini.className = 'mini-avatar ' + col;
    mini.style.background = '';
    mini.textContent = c.name.charAt(0).toUpperCase();
    // Try to load photo in background
    loadAndCachePhoto(c).then(() => {
      if (activeChat && String(activeChat.id) === String(c.id) && c.photoUrl && c.photoUrl !== 'none') {
        mini.className = 'mini-avatar';
        mini.style.background = 'none';
        mini.innerHTML = `<img src="${c.photoUrl}" style="width:100%;height:100%;object-fit:cover;border-radius:50%;display:block">`;
      }
    });
  }

  document.getElementById('chat-name-label').textContent = c.name;
  initQuickReplies();
  toggleQuickReplies(false);
  renderMessages();
  document.getElementById('list-screen').classList.add('hidden-left');
  document.getElementById('chat-screen').classList.remove('hidden-right');
  startForegroundPoll();
}

function closeChat() {
  document.getElementById('chat-screen').classList.add('hidden-right');
  document.getElementById('list-screen').classList.remove('hidden-left');
  stopForegroundPoll();
  activeChat = null;
  clearAttach();
}

// ═══ RENDER MESSAGES ═══
function renderMessages() {
  const box = document.getElementById('chat-box');
  box.innerHTML = '';
  if (!activeChat) return;
  const msgs = activeChat.messages;
  msgs.forEach((m, i) => {
    const prev = msgs[i-1], next = msgs[i+1];
    if (!prev || !sameDay(prev.ts, m.ts)) {
      const d = document.createElement('div');
      d.className = 'date-divider'; d.textContent = formatDate(m.ts);
      box.appendChild(d);
    }
    renderBubble(m, prev, next, false);
  });
  scrollBottom(false);
}

function renderBubble(m, prev, next, animate) {
  const box  = document.getElementById('chat-box');
  const dir  = m.out ? 'out' : 'in';
  const sameAsPrev = prev && prev.out === m.out;
  const sameAsNext = next && next.out === m.out;
  const i = chats.indexOf(activeChat);
  const col = COLORS[i % COLORS.length];

  const row = document.createElement('div');
  row.className = `bubble-row ${dir}${sameAsPrev ? ' consecutive' : ''}`;
  if (!animate) row.style.animation = 'none';

  const avatarHtml = !m.out
    ? (() => {
        const hidden = sameAsNext ? 'hidden' : '';
        const letter = (activeChat?.name||'?').charAt(0).toUpperCase();
        if (activeChat?.photoUrl && activeChat.photoUrl !== 'none') {
          return `<div class="bubble-avatar ${hidden}" style="background:none;overflow:hidden"><img src="${activeChat.photoUrl}" style="width:100%;height:100%;object-fit:cover;border-radius:50%;" onerror="this.parentElement.textContent='${letter}'"></div>`;
        }
        return `<div class="bubble-avatar ${col} ${hidden}">${letter}</div>`;
      })()
    : '';

  let bubbleContent = '';
  const type = m.type || 'text';

  if (type === 'photo' || type === 'sticker') {
    const stickerClass = type === 'sticker' ? ' sticker' : '';
    bubbleContent = `
      <div class="bubble media-bubble${stickerClass}" onclick="openLightbox('${esc(m.fileUrl||'')}','photo','${esc(m.fileName||'photo.jpg')}')">
        <img src="${esc(m.fileUrl||m.thumb||'')}" alt="Fotoğraf" loading="lazy"
          onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22200%22 height=%22150%22><rect width=%22200%22 height=%22150%22 fill=%22%233a3a3c%22/><text x=%2250%25%22 y=%2250%25%22 fill=%22%238e8e93%22 text-anchor=%22middle%22 dominant-baseline=%22middle%22 font-size=%2228%22>📷</text></svg>'">
      </div>`;
  } else if (type === 'video') {
    bubbleContent = `
      <div class="bubble media-bubble" onclick="openLightbox('${esc(m.fileUrl||'')}','video','${esc(m.fileName||'video.mp4')}')">
        <video src="${esc(m.fileUrl||'')}" preload="metadata" playsinline muted></video>
      </div>`;
  } else if (type === 'audio' || type === 'voice') {
    bubbleContent = `
      <div class="audio-bubble" onclick="playAudio('${esc(m.fileUrl||'')}')">
        <div class="audio-play-btn">
          <svg viewBox="0 0 24 24"><polygon points="5 3 19 12 5 21 5 3"/></svg>
        </div>
        <div class="audio-waveform">
          <span></span><span></span><span></span><span></span>
          <span></span><span></span><span></span><span></span>
        </div>
        <span class="audio-dur">${m.duration ? formatDur(m.duration) : '0:00'}</span>
      </div>`;
  } else if (type === 'document') {
    const ext = (m.fileName||'').split('.').pop().toUpperCase() || 'DOC';
    bubbleContent = `
      <div class="file-bubble" onclick="downloadFile('${esc(m.fileUrl||'')}','${esc(m.fileName||'dosya')}')">
        <div class="file-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
            <polyline points="14 2 14 8 20 8"/>
          </svg>
        </div>
        <div class="file-info">
          <div class="file-name">${esc(m.fileName||'Dosya')}</div>
          <div class="file-size">${ext} · ${m.fileSize ? fmtSize(m.fileSize) : ''}</div>
        </div>
        <div class="download-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
            <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/>
            <polyline points="7 10 12 15 17 10"/>
            <line x1="12" y1="15" x2="12" y2="3"/>
          </svg>
        </div>
      </div>`;
  } else {
    bubbleContent = `<div class="bubble">${escNL(m.text||'')}</div>`;
  }

  const timeStr = formatTime(m.ts);
  const checkHtml = m.out ? `<span class="check ${m.sent?'delivered':'sent'}">✓✓</span>` : '';

  row.innerHTML = `
    ${avatarHtml}
    <div>
      ${bubbleContent}
      <div class="bubble-meta">${timeStr} ${checkHtml}</div>
    </div>`;

  box.appendChild(row);
  if (animate) scrollBottom(true);
}

function scrollBottom(smooth) {
  const b = document.getElementById('chat-box');
  setTimeout(() => b.scrollTo({ top: b.scrollHeight, behavior: smooth ? 'smooth' : 'auto' }), 40);
}

// ═══ SEND TEXT ═══
async function sendMessage() {
  if (pendingFile) { await sendFile(); return; }
  const inp = document.getElementById('msg-input');
  const text = inp.value.trim();
  if (!text || !activeChat) return;
  if (!BOT_TOKEN) { showToast('Önce bot token gir ⚙️'); openSettingsScreen(); return; }

  inp.value = ''; inp.style.height = 'auto'; updateSendBtn();

  const msg = { type:'text', text, out:true, ts:Date.now(), sent:false };
  activeChat.messages.push(msg); saveChats(); renderMessages();

  try {
    const res = await tgAPI('sendMessage', { chat_id: activeChat.id, text });
    if (res.ok) { msg.sent = true; msg.msgId = res.result.message_id; }
    else showToast('Gönderilemedi: ' + (res.description||'Hata'));
  } catch { showToast('Bağlantı hatası 😔'); }
  saveChats(); renderMessages(); renderChatList();
}

// ═══ FILE ATTACH ═══
function onFileSelected(e) {
  const file = e.target.files[0];
  if (!file) return;
  pendingFile = file;

  const preview = document.getElementById('attach-preview');
  const thumb   = document.getElementById('attach-thumb-el');
  const nameEl  = document.getElementById('attach-name-el');
  const typeEl  = document.getElementById('attach-type-el');

  nameEl.textContent = file.name;
  thumb.innerHTML = '';

  if (file.type.startsWith('image/')) {
    typeEl.textContent = 'Fotoğraf';
    const img = document.createElement('img');
    img.src = URL.createObjectURL(file);
    thumb.appendChild(img);
  } else if (file.type.startsWith('video/')) {
    typeEl.textContent = 'Video';
    thumb.innerHTML = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" style="width:28px;height:28px;color:var(--blue)"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2"/></svg>`;
  } else if (file.type.startsWith('audio/')) {
    typeEl.textContent = 'Ses';
    thumb.innerHTML = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" style="width:28px;height:28px;color:var(--blue)"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg>`;
  } else {
    typeEl.textContent = 'Belge';
    thumb.innerHTML = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" style="width:28px;height:28px;color:var(--blue)"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>`;
  }

  preview.classList.add('show');
  updateSendBtn();
  e.target.value = '';
}

function clearAttach() {
  pendingFile = null;
  document.getElementById('attach-preview').classList.remove('show');
  updateSendBtn();
}

async function sendFile() {
  if (!pendingFile || !activeChat || !BOT_TOKEN) return;
  const file = pendingFile;
  clearAttach();
  updateSendBtn();

  const isImg   = file.type.startsWith('image/');
  const isVideo = file.type.startsWith('video/');
  const isAudio = file.type.startsWith('audio/');
  const msgType = isImg ? 'photo' : isVideo ? 'video' : isAudio ? 'audio' : 'document';

  // For images: convert to base64 so it survives page reload
  let localUrl = URL.createObjectURL(file);
  if (isImg) {
    try {
      localUrl = await new Promise((res, rej) => {
        const r = new FileReader();
        r.onload = () => res(r.result);
        r.onerror = rej;
        r.readAsDataURL(file);
      });
    } catch { /* keep blob url */ }
  }

  const msg = {
    type: msgType, fileName: file.name, fileSize: file.size,
    fileUrl: localUrl, out: true, ts: Date.now(), sent: false,
    text: file.name
  };
  activeChat.messages.push(msg); saveChats(); renderMessages();

  try {
    const fd  = new FormData();
    const key = isImg ? 'photo' : isVideo ? 'video' : isAudio ? 'audio' : 'document';
    const method = isImg ? 'sendPhoto' : isVideo ? 'sendVideo' : isAudio ? 'sendAudio' : 'sendDocument';
    fd.append('chat_id', activeChat.id);
    fd.append(key, file, file.name);

    const res = await fetch(`https://api.telegram.org/bot${BOT_TOKEN}/${method}`, { method:'POST', body:fd });
    const data = await res.json();
    if (data.ok) { msg.sent = true; msg.msgId = data.result.message_id; }
    else showToast('Gönderilemedi: ' + (data.description||'Hata'));
  } catch { showToast('Gönderim hatası 😔'); }
  saveChats(); renderMessages(); renderChatList();
}

// ═══ WAKE LOCK & KEEP ALIVE ═══
let wakeLock = null;

async function requestWakeLock() {
  if (!('wakeLock' in navigator)) return;
  try {
    wakeLock = await navigator.wakeLock.request('screen');
    wakeLock.addEventListener('release', () => { wakeLock = null; });
  } catch {}
}

async function releaseWakeLock() {
  if (wakeLock) { try { await wakeLock.release(); } catch {} wakeLock = null; }
}

// Re-acquire wake lock when page becomes visible again
document.addEventListener('visibilitychange', async () => {
  if (document.visibilityState === 'visible') {
    await requestWakeLock();
    // Resume polling immediately when user comes back
    if (BOT_TOKEN && !pollActive) {
      fetchUpdates();
    }
    if (pollActive) {
      clearTimeout(pollTimer);
      foregroundPoll();
    }
  }
});

// ═══ POLLING ═══
function startForegroundPoll() {
  stopForegroundPoll(); pollActive = true;
  requestWakeLock();
  foregroundPoll();
}
function stopForegroundPoll() { pollActive = false; clearTimeout(pollTimer); }

async function foregroundPoll() {
  if (!pollActive || !BOT_TOKEN) return;
  await fetchUpdates();
  if (pollActive) pollTimer = setTimeout(foregroundPoll, 5000);
}

function startBgPoll() {
  clearTimeout(bgPollTimer);
  if (!BOT_TOKEN) return;
  bgPollStep();
}
async function bgPollStep() {
  if (BOT_TOKEN && !pollActive) await fetchUpdates();
  bgPollTimer = setTimeout(bgPollStep, 8000);
}

async function fetchUpdates() {
  try {
    const data = await tgAPI('getUpdates', { offset: lastOffset, timeout:3, allowed_updates:['message'] });
    if (!data.ok || !data.result.length) return;

    for (const upd of data.result) {
      lastOffset = Math.max(lastOffset, upd.update_id + 1);
      const m = upd.message;
      if (!m) continue;
      const fromId = String(m.chat.id);

      let c = chats.find(x => String(x.id) === fromId);
      if (!c) {
        const name = m.from?.first_name || m.chat?.title || fromId;
        c = { id:fromId, name, messages:[], unread:false };
        chats.push(c);
        // Try to load profile photo in background
        loadAndCachePhoto(c);
      }

      const isCurrent = activeChat && String(activeChat.id) === fromId;

      // Build message object
      let msgObj = { out:false, ts: m.date*1000, sent:true, msgId: m.message_id };

      if (m.photo) {
        const ph = m.photo[m.photo.length-1];
        msgObj.type = 'photo';
        msgObj.fileId = ph.file_id;
        msgObj.text = 'Fotoğraf';
        await resolveFileUrl(msgObj);
      } else if (m.video) {
        msgObj.type = 'video';
        msgObj.fileId = m.video.file_id;
        msgObj.fileSize = m.video.file_size;
        msgObj.fileName = m.video.file_name || 'video.mp4';
        msgObj.text = 'Video';
        await resolveFileUrl(msgObj);
      } else if (m.voice) {
        msgObj.type = 'voice';
        msgObj.fileId = m.voice.file_id;
        msgObj.duration = m.voice.duration;
        msgObj.text = 'Ses mesajı';
        await resolveFileUrl(msgObj);
      } else if (m.audio) {
        msgObj.type = 'audio';
        msgObj.fileId = m.audio.file_id;
        msgObj.duration = m.audio.duration;
        msgObj.fileName = m.audio.file_name || 'audio.mp3';
        msgObj.text = m.audio.file_name || 'Ses';
        await resolveFileUrl(msgObj);
      } else if (m.document) {
        msgObj.type = 'document';
        msgObj.fileId = m.document.file_id;
        msgObj.fileName = m.document.file_name || 'dosya';
        msgObj.fileSize = m.document.file_size;
        msgObj.text = m.document.file_name || 'Dosya';
        await resolveFileUrl(msgObj);
      } else if (m.sticker) {
        msgObj.type = 'sticker';
        msgObj.fileId = m.sticker.file_id;
        msgObj.text = 'Sticker';
        await resolveFileUrl(msgObj);
      } else if (m.text) {
        msgObj.type = 'text';
        msgObj.text = m.text;
      } else {
        continue;
      }

      const dup = c.messages.some(x => x.msgId === m.message_id);
      if (!dup) {
        c.messages.push(msgObj);
        if (!isCurrent) c.unread = true;
      }
    }

    saveChats();
    renderChatList();
    if (activeChat) renderMessages();
  } catch {}
}

// ═══ FILE URL RESOLVER ═══
async function resolveFileUrl(msgObj) {
  if (!msgObj.fileId || !BOT_TOKEN) return;
  try {
    const r = await tgAPI('getFile', { file_id: msgObj.fileId });
    if (r.ok) {
      msgObj.fileUrl = `https://api.telegram.org/file/bot${BOT_TOKEN}/${r.result.file_path}`;
    }
  } catch {}
}

// ═══ LIGHTBOX ═══
function openLightbox(url, type, name) {
  if (!url) return;
  lightboxUrl = { url, name };
  const lb = document.getElementById('lightbox');
  const cnt = document.getElementById('lightbox-content');
  cnt.innerHTML = '';
  if (type === 'photo') {
    const img = document.createElement('img');
    img.src = url; cnt.appendChild(img);
  } else if (type === 'video') {
    const vid = document.createElement('video');
    vid.src = url; vid.controls = true; vid.autoplay = true;
    cnt.appendChild(vid);
  }
  lb.classList.add('open');
}
function closeLightbox(e) {
  if (e && e.target !== document.getElementById('lightbox') && !e.target.closest('.lightbox-close')) return;
  document.getElementById('lightbox').classList.remove('open');
  document.getElementById('lightbox-content').innerHTML = '';
}
function lightboxDownload() {
  if (!lightboxUrl) return;
  const a = document.createElement('a');
  a.href = lightboxUrl.url; a.download = lightboxUrl.name || 'download';
  a.target = '_blank'; a.click();
}

function playAudio(url) {
  if (!url) return;
  new Audio(url).play().catch(() => showToast('Ses oynatılamadı'));
}

function downloadFile(url, name) {
  if (!url) { showToast('Dosya henüz yüklenmedi'); return; }
  const a = document.createElement('a');
  a.href = url; a.download = name || 'dosya'; a.target = '_blank'; a.click();
}

// ═══ SETTINGS ═══
function toggleTokenVis() {
  const inp = document.getElementById('s-token');
  const showing = inp.style.webkitTextSecurity !== 'none';
  inp.style.webkitTextSecurity = showing ? 'none' : 'disc';
  inp.type = showing ? 'text' : 'password';
}

function initTokenStatus() {
  const dot  = document.getElementById('status-dot');
  const text = document.getElementById('status-text');
  if (BOT_TOKEN) {
    dot.className = 'status-dot connected';
    text.textContent = 'Bağlı';
  } else {
    dot.className = 'status-dot';
    text.textContent = 'Token girilmedi';
  }
}

async function saveToken() {
  const t = document.getElementById('s-token').value.trim();
  if (!t) { showToast('Token boş olamaz'); return; }

  const dot  = document.getElementById('status-dot');
  const text = document.getElementById('status-text');
  dot.className = 'status-dot'; text.textContent = 'Kontrol ediliyor...';

  try {
    const r = await fetch(`https://api.telegram.org/bot${t}/getMe`);
    const d = await r.json();
    if (d.ok) {
      BOT_TOKEN = t;
      localStorage.setItem('tg_token', t);
      dot.className = 'status-dot connected';
      text.textContent = 'Bağlandı ✓';

      const card = document.getElementById('bot-info-card');
      document.getElementById('bot-avatar-letter').textContent = d.result.first_name.charAt(0);
      document.getElementById('bot-name-text').textContent = d.result.first_name;
      document.getElementById('bot-handle-text').textContent = '@' + d.result.username;
      card.classList.add('show');

      showToast('Bot bağlandı! ' + d.result.first_name + ' ✓');
      startBgPoll();
    } else {
      dot.className = 'status-dot error';
      text.textContent = 'Geçersiz token';
      showToast('Geçersiz token! Bot bulunamadı.');
    }
  } catch {
    dot.className = 'status-dot error';
    text.textContent = 'Bağlantı hatası';
    showToast('Bağlantı hatası 😔');
  }
}

function clearAllChats() {
  if (!confirm('Tüm sohbetler silinecek. Emin misin?')) return;
  chats = []; saveChats(); renderChatList();
  showToast('Tüm sohbetler temizlendi');
}

// ═══ NEW CHAT MODAL ═══
function openNewMsg() {
  document.getElementById('new-msg-modal').classList.add('open');
  setTimeout(() => document.getElementById('new-chat-id').focus(), 300);
}
function closeNewMsg() { document.getElementById('new-msg-modal').classList.remove('open'); }
function startChat() {
  const id   = document.getElementById('new-chat-id').value.trim();
  const name = document.getElementById('new-chat-name').value.trim() || id;
  if (!id) { showToast('Chat ID boş olamaz'); return; }
  let c = chats.find(x => String(x.id) === String(id));
  if (!c) { c = { id, name, messages:[], unread:false }; chats.push(c); saveChats(); }
  document.getElementById('new-chat-id').value = '';
  document.getElementById('new-chat-name').value = '';
  closeNewMsg();
  openChat(c);
}

// ═══ TELEGRAM API ═══
async function tgAPI(method, params={}) {
  const r = await fetch(`https://api.telegram.org/bot${BOT_TOKEN}/${method}`, {
    method:'POST', headers:{'Content-Type':'application/json'}, body:JSON.stringify(params)
  });
  return r.json();
}

// ═══ UTILS ═══
function esc(s) {
  return String(s)
    .replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;')
    .replace(/"/g,'&quot;').replace(/'/g,'&#039;');
}
function escNL(s) { return esc(s).replace(/\n/g,'<br>'); }

function formatTime(ts) {
  return new Date(ts).toLocaleTimeString('tr-TR',{hour:'2-digit',minute:'2-digit'});
}
function formatDate(ts) {
  const d = new Date(ts), now = new Date();
  if (sameDay(ts, now.getTime())) return 'Bugün';
  if (sameDay(ts, now.getTime()-86400000)) return 'Dün';
  return d.toLocaleDateString('tr-TR',{day:'numeric',month:'long',year:'numeric'});
}
function sameDay(a,b) {
  const x=new Date(a), y=new Date(b);
  return x.getFullYear()===y.getFullYear()&&x.getMonth()===y.getMonth()&&x.getDate()===y.getDate();
}
function fmtSize(bytes) {
  if (!bytes) return '';
  if (bytes < 1024) return bytes + ' B';
  if (bytes < 1024*1024) return (bytes/1024).toFixed(1) + ' KB';
  return (bytes/1024/1024).toFixed(1) + ' MB';
}
function formatDur(s) {
  return Math.floor(s/60) + ':' + String(s%60).padStart(2,'0');
}
// ═══ CONTACT MODAL ═══
let contactModalChat = null;
let contactRefreshTimer = null;

function cmSetSkeleton(on) {
  ['cm-fullname','cm-uname','cm-phone','cm-bio'].forEach(id => {
    const el = document.getElementById(id);
    if (!el) return;
    if (on) el.classList.add('skeleton');
    else el.classList.remove('skeleton');
  });
}

async function openContactModal() {
  if (!activeChat) return;
  contactModalChat = activeChat;
  const c = activeChat;
  const modal = document.getElementById('contact-modal');
  const i = chats.indexOf(c);
  const col = COLORS[i % COLORS.length];

  // Avatar
  const cmAv = document.getElementById('cm-avatar');
  if (c.photoUrl && c.photoUrl !== 'none') {
    cmAv.style.background = 'none';
    cmAv.className = 'cm-avatar';
    cmAv.innerHTML = `<img src="${c.photoUrl}" alt="${esc(c.name)}" onerror="this.parentElement.textContent='${c.name.charAt(0).toUpperCase()}'">`;
  } else {
    cmAv.innerHTML = c.name.charAt(0).toUpperCase();
    cmAv.className = 'cm-avatar ' + col;
    cmAv.style.background = '';
  }

  // Fill with cached data first
  document.getElementById('cm-name').textContent = c.fullName || c.name || '—';
  document.getElementById('cm-chatid').textContent = c.id || '—';
  document.getElementById('cm-username').textContent = c.username ? '@' + c.username : '—';

  // Show skeleton on fields that may update
  const hasCache = !!(c.fullName || c.username || c.phone || c.bio);
  if (!hasCache) {
    cmSetSkeleton(true);
    document.getElementById('cm-fullname').textContent = '';
    document.getElementById('cm-uname').textContent = '';
    document.getElementById('cm-phone').textContent = '';
    document.getElementById('cm-bio').textContent = '';
  } else {
    document.getElementById('cm-fullname').textContent = c.fullName || c.name || '—';
    document.getElementById('cm-uname').textContent = c.username ? '@' + c.username : 'Gizli';
    document.getElementById('cm-phone').textContent = c.phone || 'Gizli / Paylaşılmamış';
    document.getElementById('cm-bio').textContent = c.bio || '—';
  }

  modal.classList.add('open');

  // First fetch immediately
  if (BOT_TOKEN) await fetchContactInfo(c);

  // Then refresh every 10 seconds while modal is open
  clearInterval(contactRefreshTimer);
  contactRefreshTimer = setInterval(async () => {
    if (!contactModalChat || !document.getElementById('contact-modal').classList.contains('open')) {
      clearInterval(contactRefreshTimer); return;
    }
    if (BOT_TOKEN) await fetchContactInfo(contactModalChat);
  }, 10000);
}

async function fetchContactInfo(c) {
  try {
    const r = await tgAPI('getChat', { chat_id: c.id });
    if (!r.ok) { cmSetSkeleton(false); return; }
    const d = r.result;

    if (d.first_name || d.last_name)
      c.fullName = [d.first_name, d.last_name].filter(Boolean).join(' ');
    if (d.username)     c.username = d.username;
    if (d.bio)          c.bio = d.bio;
    if (d.phone_number) c.phone = d.phone_number;
    saveChats();

    // Update modal DOM if still open for this chat
    if (contactModalChat && String(contactModalChat.id) === String(c.id)) {
      cmSetSkeleton(false);
      document.getElementById('cm-name').textContent     = c.fullName || c.name || '—';
      document.getElementById('cm-fullname').textContent = c.fullName || c.name || '—';
      document.getElementById('cm-username').textContent = c.username ? '@' + c.username : '—';
      document.getElementById('cm-uname').textContent    = c.username ? '@' + c.username : 'Gizli / Paylaşılmamış';
      document.getElementById('cm-phone').textContent    = c.phone || 'Gizli / Paylaşılmamış';
      document.getElementById('cm-bio').textContent      = c.bio || '—';

      // Also update header name
      document.getElementById('chat-name-label').textContent = c.fullName || c.name;
    }

    // Profile photo
    if (!c.photoUrl || c.photoUrl === 'none') {
      await loadAndCachePhoto(c);
    }
    if (c.photoUrl && c.photoUrl !== 'none' && contactModalChat && String(contactModalChat.id) === String(c.id)) {
      const cmAv = document.getElementById('cm-avatar');
      cmAv.style.background = 'none';
      cmAv.className = 'cm-avatar';
      cmAv.innerHTML = `<img src="${c.photoUrl}" alt="${esc(c.name)}" onerror="this.parentElement.textContent='${(c.name||'?').charAt(0).toUpperCase()}'">`;
    }
  } catch { cmSetSkeleton(false); }
}

function closeContactModal() {
  document.getElementById('contact-modal').classList.remove('open');
  contactModalChat = null;
  clearInterval(contactRefreshTimer);
}

function cmSendMsg() {
  closeContactModal();
  // Already in chat, just focus input
  setTimeout(() => document.getElementById('msg-input').focus(), 300);
}

function cmOpenTelegram() {
  const c = contactModalChat;
  if (!c) return;
  const url = c.username
    ? `https://t.me/${c.username}`
    : `https://t.me/+${c.id}`;
  window.open(url, '_blank');
}

function cmCopyId() {
  if (!contactModalChat) return;
  navigator.clipboard?.writeText(String(contactModalChat.id))
    .then(() => showToast('Chat ID kopyalandı ✓'))
    .catch(() => showToast('ID: ' + contactModalChat.id));
}

function deleteThisChat() {
  if (!contactModalChat) return;
  if (!confirm(`"${contactModalChat.name}" sohbeti silinsin mi?`)) return;
  chats = chats.filter(c => String(c.id) !== String(contactModalChat.id));
  saveChats();
  closeContactModal();
  closeChat();
  renderChatList();
  showToast('Sohbet silindi');
}

function showToast(msg) {
  const t = document.getElementById('toast');
  t.textContent = msg; t.classList.add('show');
  setTimeout(() => t.classList.remove('show'), 2600);
}
</script>
</body>
</html>