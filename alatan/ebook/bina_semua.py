import sys,os,json; sys.path.insert(0,'.')
import isi_a,isi_b,isi_c
out=os.path.abspath('out')
D=os.path.dirname(os.path.abspath(__file__))
# (mod teks, kedudukan menegak, lebar blok, saiz tajuk) bagi setiap seni kulit di seni/seni-NN.jpg
K=[('gelap','47%','60%','26pt'),('gelap','37%','76%','28pt'),('gelap','44%','46%','17pt'),('cerah','50%','58%','24pt'),('gelap','47%','56%','24pt'),
   ('gelap','39%','76%','27pt'),('cerah','48%','66%','23pt'),('cerah','40%','60%','23pt'),('gelap','52%','70%','26pt'),('cerah','48%','62%','21pt')]
F=[isi_a.e1,isi_b.e2,isi_a.e3,isi_b.e4,isi_b.e5,isi_b.e6,isi_c.e7,isi_c.e8,isi_c.e9,isi_c.e10]
meta=[]
for i,f in enumerate(F):
    b=f(); b.seni=f'{D}/seni/seni-{i+1:02d}.jpg'; b.mod,b.atas,b.lebar,b.saiz=K[i]; b.bina(out); meta.append({'slug':b.slug,'tajuk':b.tajuk,'sub':b.sub})
json.dump(meta,open(out+'/meta.json','w'),ensure_ascii=False,indent=1); print(' '.join(m['slug'] for m in meta))
