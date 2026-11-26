const {chromium}=require('playwright');const fs=require('fs');
(async()=>{const out=process.argv[2];const slugs=process.argv.slice(3);const b=await chromium.launch();
for(const s of slugs){
  const p=await b.newPage({viewport:{width:559,height:794},deviceScaleFactor:2});
  await p.goto('file://'+out+'/tmp/'+s+'-kulit.html',{waitUntil:'networkidle'});await p.evaluate(()=>document.fonts.ready);
  await p.pdf({path:out+'/tmp/'+s+'-kulit.pdf',width:'148mm',height:'210mm',printBackground:true});
  await p.screenshot({path:out+'/kulit/'+s+'.jpg',type:'jpeg',quality:86,clip:{x:0,y:0,width:559,height:794}});
  await p.goto('file://'+out+'/tmp/'+s+'-isi.html',{waitUntil:'networkidle'});await p.evaluate(()=>document.fonts.ready);
  await p.pdf({path:out+'/tmp/'+s+'-isi.pdf',width:'148mm',height:'210mm',printBackground:true,displayHeaderFooter:true,headerTemplate:'<span></span>',
    footerTemplate:'<div style="width:100%;font:500 7pt sans-serif;color:#7281A8;padding:0 14mm;display:flex;justify-content:space-between"><span>Muafakat Care · muafakatcare.my</span><span class="pageNumber"></span></div>'});
  await p.close();}
await b.close()})()
