import json,sys,re,os
D=os.path.dirname(os.path.abspath(__file__))
_c={}
def load(l,b):
    k=l+'-'+b
    if k not in _c: _c[k]={h['hadithnumber']:h for h in json.load(open(f'{D}/{k}.json',encoding='utf8'))['hadiths']}
    return _c[k]
def cari(buku,*kata,maks=4):
    out=[]
    for n,h in load('eng',buku).items():
        t=h['text'].lower()
        if all(k.lower() in t for k in kata): out.append((len(t),n,h['text']))
    out.sort()
    return out[:maks]
if __name__=='__main__':
    buku=sys.argv[1]; kata=sys.argv[2:]
    for L,n,t in cari(buku,*kata): print(buku,n,L,'|',t[:330].replace('\n',' ')); 
