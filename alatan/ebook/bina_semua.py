import sys,os,json; sys.path.insert(0,'.')
import isi_a,isi_b,isi_c
out=os.path.abspath('out')
T=[('#1E1A68','#5E59A6','#C5162E'),('#C5162E','#ED2B3A','#1E1A68','#1E1A68'),('#0F1235','#1E1A68','#C5162E'),('#5E59A6','#7281A8','#1E1A68','#C5162E'),('#1E1A68','#C5162E','#5E59A6')]
F=[isi_a.e1,isi_b.e2,isi_a.e3,isi_b.e4,isi_b.e5,isi_b.e6,isi_c.e7,isi_c.e8,isi_c.e9,isi_c.e10]
meta=[]
for i,f in enumerate(F):
    b=f(); b.tema=T[i%len(T)]; b.bina(out); meta.append({'slug':b.slug,'tajuk':b.tajuk,'sub':b.sub})
json.dump(meta,open(out+'/meta.json','w'),ensure_ascii=False,indent=1); print(' '.join(m['slug'] for m in meta))
