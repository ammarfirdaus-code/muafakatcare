import json,os,sys,subprocess,html,re,urllib.request
D=os.path.dirname(os.path.abspath(__file__)); sys.path.insert(0,D)
from cari import load
E=html.escape
NAMA={'bukhari':'Riwayat al-Bukhari','muslim':'Riwayat Muslim','tirmidhi':'Riwayat at-Tirmizi','abudawud':'Riwayat Abu Daud','ibnmajah':'Riwayat Ibn Majah','nasai':"Riwayat an-Nasa'i"}
SURAH={2:'al-Baqarah',3:"Ali 'Imran",9:'at-Taubah',14:'Ibrahim',17:"al-Isra'",25:'al-Furqan',27:'an-Naml',34:"Saba'",35:'Fatir',47:'Muhammad',51:'az-Zariyat',57:'al-Hadid',63:'al-Munafiqun',64:'at-Taghabun',65:'at-Talaq',71:'Nuh',76:'al-Insan',90:'al-Balad',92:'al-Lail',93:'ad-Duha',107:"al-Ma'un",59:'al-Hasyr',62:"al-Jumu'ah",18:'al-Kahfi',33:'al-Ahzab',46:'al-Ahqaf'}
_qc=os.path.join(D,'quran.json'); _q=json.load(open(_qc)) if os.path.exists(_qc) else {}
def ayat(ruj):
    """ruj '2:261' atau '2:262-263' -> (arab, terjemahan Basmeih, label)"""
    s,a=ruj.split(':'); a1,a2=(a.split('-')+[a])[:2] if '-' in a else (a,a)
    ar=[];ms=[]
    for n in range(int(a1),int(a2)+1):
        k=f'{s}:{n}'
        if k not in _q:
            d=json.load(urllib.request.urlopen(f'https://api.alquran.cloud/v1/ayah/{k}/editions/quran-uthmani,ms.basmeih',timeout=30))
            assert d['code']==200,k
            _q[k]={e['edition']['identifier']:e['text'] for e in d['data']}; json.dump(_q,open(_qc,'w'),ensure_ascii=False)
        t=_q[k]['quran-uthmani']
        if n==1 and int(s) not in (1,9): t=t.replace('بِسْمِ ٱللَّهِ ٱلرَّحْمَٰنِ ٱلرَّحِيمِ ','',1)
        ar.append(t+' ﴿'+''.join('٠١٢٣٤٥٦٧٨٩'[int(c)] for c in str(n))+'﴾'); ms.append(_q[k]['ms.basmeih'])
    return ' '.join(ar),' '.join(ms),f'Surah {SURAH[int(s)]}, ayat {a}'
def hadis(buku,no): return load('ara',buku)[no]['text'].strip(), NAMA[buku]

CSS='''@import url('https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Inter:wght@400;500;600&family=Poppins:wght@600;700;800&display=swap');
@page{size:148mm 210mm;margin:16mm 14mm 18mm}
*{box-sizing:border-box}body{margin:0;font:400 10.5pt/1.6 Inter,sans-serif;color:#2B2E3A}
h1,h2,h3{font-family:Poppins,sans-serif;color:#1E1A68;line-height:1.25;margin:0 0 .5em}
h2{font-size:17pt;font-weight:700}h3{font-size:12pt;font-weight:600}
p{margin:0 0 .8em}ul,ol{margin:0 0 .8em;padding-left:1.3em}li{margin-bottom:.35em}
.hal{break-before:page}.hal:first-child{break-before:auto}
.eyebrow{display:inline-block;font:600 7.5pt Inter;letter-spacing:.14em;text-transform:uppercase;color:#fff;background:#C5162E;padding:4px 10px;border-radius:99px;margin-bottom:10px}
.arab{font:400 17pt/2.1 Amiri,serif;direction:rtl;text-align:right;color:#0F1235;background:#F5F6FA;border-right:4px solid #C5162E;border-radius:10px;padding:12px 16px;margin:0 0 12px}
.arab.pjg{font-size:13.5pt;line-height:2}
.terj{font-size:11pt;color:#1E1A68;font-weight:500}.ruj{font:600 8.5pt Inter;color:#C5162E;letter-spacing:.04em;margin-bottom:12px}
.kotak{background:#F4D9DE;border-radius:10px;padding:10px 14px;margin-top:10px;font-size:10pt;break-inside:avoid}.kotak b{color:#C5162E}
.biru{background:#F5F6FA;border-left:4px solid #1E1A68;border-radius:8px;padding:10px 14px;margin:0 0 12px;break-inside:avoid}
.no{font:800 30pt/1 Poppins;color:#E8EAF2;float:right}
table{width:100%;border-collapse:collapse;margin:0 0 12px;font-size:9.5pt}th,td{border:1px solid #E8EAF2;padding:6px 8px;text-align:left;vertical-align:top}th{background:#1E1A68;color:#fff;font-weight:600}
.petak{display:grid;grid-template-columns:repeat(5,1fr);gap:6px;margin:8px 0 14px}.petak div{border:1.5px solid #5E59A6;border-radius:8px;height:40px;font:600 8pt Inter;color:#5E59A6;padding:3px 5px}
.garis{border-bottom:1px solid #7281A8;height:22px}.semak li{list-style:none;position:relative;margin-left:-1.3em;padding-left:1.7em}.semak li::before{content:"";position:absolute;left:0;top:3px;width:11px;height:11px;border:1.5px solid #1E1A68;border-radius:3px}
.cta{background:#1E1A68;color:#fff;border-radius:14px;padding:18px;text-align:center;margin-top:14px;break-inside:avoid}.cta h3{color:#fff}.cta .u{display:inline-block;background:#C5162E;color:#fff;font:600 10pt Poppins;padding:8px 18px;border-radius:99px;margin-top:6px;text-decoration:none}
.kecil{font-size:8.5pt;color:#7281A8}
/* kulit */
.kulit{width:148mm;height:210mm;background:#1E1A68;color:#fff;padding:16mm 13mm;display:flex;flex-direction:column;position:relative;overflow:hidden}
.kulit::before{content:"";position:absolute;right:-40mm;top:-30mm;width:120mm;height:120mm;border-radius:50%;background:#5E59A6;opacity:.45}
.kulit::after{content:"";position:absolute;left:-25mm;bottom:-35mm;width:90mm;height:90mm;border-radius:50%;background:#C5162E;opacity:.9}
.kulit>*{position:relative;z-index:1}.kulit .logo{background:#fff;border-radius:10px;padding:6px 10px;align-self:flex-start}.kulit .logo img{height:15mm;display:block}
.kulit .tanda{margin-top:auto;font:600 8pt Inter;letter-spacing:.16em;text-transform:uppercase;background:#C5162E;align-self:flex-start;padding:5px 12px;border-radius:99px}
.kulit h1{font:800 27pt/1.12 Poppins;color:#fff;margin:12px 0 10px}.kulit .sub{font-size:12pt;color:#d9dbee;max-width:95mm;margin-bottom:26mm}
.kulit .kaki{font:500 8.5pt Inter;color:#fff;text-align:right}'''
LOGO='file:///home/user/muafakatcare/public/img/logo.png'
class Buku:
    def __init__(s,slug,tajuk,sub): s.slug,s.tajuk,s.sub,s.b=slug,tajuk,sub,[]
    def hal(s,isi,eyebrow=None): s.b.append('<section class="hal">'+(f'<span class="eyebrow">{E(eyebrow)}</span><br>' if eyebrow else '')+isi+'</section>'); return s
    def teks(s,tajuk,*per,eyebrow=None):
        out=f'<h2>{E(tajuk)}</h2>'
        for p in per:
            if isinstance(p,(list,tuple)): out+='<ul>'+''.join(f'<li>{x}</li>' for x in p)+'</ul>'
            elif p.startswith('<'): out+=p
            else: out+=f'<p>{p}</p>'
        return s.hal(out,eyebrow)
    def hadis(s,i,buku,no,terj,amal,tajuk):
        ar,ruj=hadis(buku,no)
        return s.hal(f'<span class="no">{i:02d}</span><h3>{E(tajuk)}</h3><div class="arab{" pjg" if len(ar)>330 else ""}">{E(ar)}</div><p class="terj">“{terj}”</p><p class="ruj">{ruj}</p><div class="kotak"><b>Amalkan hari ini:</b> {amal}</div>','Hadis '+str(i))
    def ayat(s,i,ruj,tajuk,tad,soal):
        ar,ms,lab=ayat(ruj)
        return s.hal(f'<span class="no">{i:02d}</span><h3>{E(tajuk)}</h3><div class="arab{" pjg" if len(ar)>300 else ""}">{E(ar)}</div><p class="terj">“{E(ms)}”</p><p class="ruj">{lab}</p>'+''.join(f'<p>{t}</p>' for t in tad)+f'<div class="kotak"><b>Tanya diri:</b> {soal}</div>','Ayat '+str(i))
    def tutup(s,tajuk,ayat_,url,label):
        return s.hal(f'<h2>{E(tajuk)}</h2><p>{ayat_}</p><div class="cta"><h3>{E(label)}</h3><p style="margin:0">Setiap sumbangan direkod dan dilaporkan di Papan Impak.</p><span class="u">{E(url)}</span></div>'
          '<p class="kecil" style="margin-top:16px">eBook ini diedarkan percuma oleh Muafakat Care, program Pertubuhan Kebajikan Muafakat Bakri (PPM-002-10-13032020). Teks Al-Quran: rasm Uthmani; terjemahan: Tafsir Pimpinan Ar-Rahman (Abdullah Basmeih). Teks hadis diambil daripada kitab yang dinyatakan pada setiap halaman; terjemahan hadis oleh penyusun. Sekiranya terdapat kesilapan, maklumkan kepada kami di muafakatbakri@gmail.com supaya dapat dibetulkan.</p>','Penutup')
    def bina(s,out):
        g=getattr(s,'seni',None); mod=getattr(s,'mod','gelap'); atas=getattr(s,'atas','44%'); lebar=getattr(s,'lebar','64%'); saiz=getattr(s,'saiz','23pt')
        kulit=(f'<!doctype html><meta charset="utf-8"><style>{CSS}@page{{margin:0}}'
          f'.k2{{width:148mm;height:210mm;position:relative;background:url("file://{g}") center/cover;overflow:hidden}}'
          f'.blok{{position:absolute;left:50%;top:{atas};transform:translate(-50%,-50%);width:{lebar};text-align:center}}'
          '.blok .logo{display:inline-block;background:#fff;border-radius:9px;padding:5px 9px;box-shadow:0 2px 8px rgba(0,0,0,.25)}.blok .logo img{height:13mm;display:block}'
          '.blok .tanda{display:block;margin:9px auto 8px;font:600 7pt Inter;letter-spacing:.2em;text-transform:uppercase}'
          f'.blok h1{{font:800 {saiz}/1.14 Poppins;margin:0 0 8px}}.blok .sub{{font:500 10.5pt/1.4 Inter;margin:0 auto;max-width:92%}}.blok .garis2{{width:26mm;height:1.5px;margin:9px auto}}'
          '.blok .kaki{font:600 7pt Inter;letter-spacing:.08em;margin-top:2px}'
          '.gelap h1{color:#fff;text-shadow:0 2px 10px rgba(0,0,0,.45)}.gelap .tanda,.gelap .kaki{color:#F3CF73}.gelap .sub{color:#F1F1F8;text-shadow:0 1px 6px rgba(0,0,0,.5)}.gelap .garis2{background:#E3B341}'
          '.cerah h1{color:#1E1A68}.cerah .tanda,.cerah .kaki{color:#C5162E}.cerah .sub{color:#2B2E3A}.cerah .garis2{background:#B8892B}'
          f'</style><div class="k2"><div class="blok {mod}"><span class="logo"><img src="{LOGO}"></span><span class="tanda">eBook Percuma</span><h1>{E(s.tajuk)}</h1><div class="sub">{E(s.sub)}</div><div class="garis2"></div><div class="kaki">MUAFAKAT CARE · muafakatcare.my</div></div></div>')
        isi=f'<!doctype html><meta charset="utf-8"><style>{CSS}</style>'+''.join(s.b)
        os.makedirs(out+'/tmp',exist_ok=True)
        open(f'{out}/tmp/{s.slug}-kulit.html','w',encoding='utf8').write(kulit); open(f'{out}/tmp/{s.slug}-isi.html','w',encoding='utf8').write(isi)
        return s.slug
