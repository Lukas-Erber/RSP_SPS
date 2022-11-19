% g) Vytvořte další skript "znamkovani" novém skriptu vytvořte program pro určení
% známky dle bodového hodnocení viz. schéma v přednášce
body = randi(100,1);
znamka = 'Z';
if body >= 90
    znamka = 'A';
elseif body<90 && body>=80 
    znamka = 'B';
elseif body<80 && body>=70 
    znamka = 'C';
elseif body<70 && body>=60 
    znamka = 'D';
else
    znamka = 'F';
end;