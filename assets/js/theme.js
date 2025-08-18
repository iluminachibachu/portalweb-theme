// ===== Font size switch =====
(function(){
  const body = document.body;
  const small = document.getElementById('fsSmall');
  const large = document.getElementById('fsLarge');
  const stateKey = 'fontSizeMode';

  function setMode(mode){
    body.classList.remove('fs-small','fs-medium','fs-large');
    body.classList.add(mode);
    small.setAttribute('aria-pressed', String(mode==='fs-small'));
    large.setAttribute('aria-pressed', String(mode==='fs-large'));
    try{localStorage.setItem(stateKey, mode)}catch(e){}
  }
  // init
  const saved = localStorage.getItem(stateKey);
  setMode(saved || 'fs-medium');
  small.addEventListener('click',()=>setMode('fs-small'));
  large.addEventListener('click',()=>setMode('fs-large'));
})();

// ===== Back to top =====
document.getElementById('toTop').addEventListener('click', ()=>{
  window.scrollTo({top:0, behavior:'smooth'});
});

// ===== Dialog helpers =====
function setupDialog(triggerId, dialogId){
  const trigger = document.getElementById(triggerId);
  const dlg = document.getElementById(dialogId);
  if(!trigger || !dlg) return;
  trigger.addEventListener('click', ()=>{
    if(typeof dlg.showModal === 'function'){ dlg.showModal(); }
    else{ dlg.setAttribute('open',''); }
  });
  // close on click of cancel or backdrop
  dlg.addEventListener('click', (e)=>{
    const rect = dlg.getBoundingClientRect();
    const inDialog = rect.top <= e.clientY && e.clientY <= rect.bottom && rect.left <= e.clientX && e.clientX <= rect.right;
    if(!inDialog) dlg.close();
  });
  dlg.addEventListener('cancel', (e)=>{ e.preventDefault(); dlg.close(); });
  dlg.querySelectorAll('[value="cancel"]').forEach(btn=>btn.addEventListener('click', ()=>dlg.close()));
}
setupDialog('btnSearch','dlgSearch');
setupDialog('btnTopics','dlgTopics');