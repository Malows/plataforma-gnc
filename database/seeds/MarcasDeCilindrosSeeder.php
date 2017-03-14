<?php

use Illuminate\Database\Seeder;

class MarcasDeCilindrosSeeder extends Seeder
{
    protected $datos = [
        ["nombre" => "ANSI"],["nombre" => "CHESTERFIE"],["nombre" => "CILBRAS"],
        ["nombre" => "DALMINE"],["nombre" => "ECOTEMP"],["nombre" => "FABER"],
        ["nombre" => "GIFFEL"],["nombre" => "IMZ"],["nombre" => "INFLEX"],
        ["nombre" => "KMAR"],["nombre" => "pasquinelli"],["nombre" => "MAT INCEND"],
        ["nombre" => "MESCOGAS"],["nombre" => "NI INDUSTR"],["nombre" => "NORRIS"],
        ["nombre" => "PISL"],["nombre" => "SARAVIA"],["nombre" => "SIMMEL"],
        ["nombre" => "SITEA"],["nombre" => "TAYLOR WHA"],["nombre" => "WORTHINGTO"],
        ["nombre" => "PRAXAIR"],["nombre" => "L.S."],["nombre" => "YUKON"],
        ["nombre" => "TUBOGAS"],["nombre" => "GIORGIA"],["nombre" => "Sin Marca"],
        ["nombre" => "DRAGO"],["nombre" => "AIB"],["nombre" => "M.D."],
        ["nombre" => "G.C.A."],["nombre" => "AGA"],["nombre" => "GIL"],
        ["nombre" => "LPH"],["nombre" => "IMG"],["nombre" => "T.B.U."],
        ["nombre" => "B.F.C."],["nombre" => "ATE"],["nombre" => "M.V."],
        ["nombre" => "M.R.B."],["nombre" => "S.H.P."],["nombre" => "V.T."],
        ["nombre" => "Fadesa"],["nombre" => "CTD"],["nombre" => "PUMPER"],
        ["nombre" => "MELISAN"],["nombre" => "EXTINTOR"],["nombre" => "Unitor"],
        ["nombre" => "Premier"],["nombre" => "kioshi"],["nombre" => "D.J."],
        ["nombre" => "INPROCIL"],["nombre" => "A.T.B."],["nombre" => "A.B."],
        ["nombre" => "M.W"],["nombre" => "RESIL"],["nombre" => "eurocil"],
        ["nombre" => "CIDEGAS"],["nombre" => "ARGENTOIL"],["nombre" => "MATHIL"],
        ["nombre" => "Luxfer"],["nombre" => "EKC"],["nombre" => "YANES"],
        ["nombre" => "MSA(equip)"],["nombre" => "kioshi compresion"],["nombre" => "Draeger"],
        ["nombre" => "HEISER"],["nombre" => "DRAGER"],["nombre" => "Coyne"],
        ["nombre" => "TWC"],["nombre" => "INDURA"],["nombre" => "M97"],
        ["nombre" => "GALLIATE"],["nombre" => "CUSTOMER"],["nombre" => "LGB"],
        ["nombre" => "Antartida"],["nombre" => "La Oxigena"],["nombre" => "T.W"],
        ["nombre" => "TW"],["nombre" => "JBP"],["nombre" => "FISTORAY"],
        ["nombre" => "HERO"],["nombre" => "YM"],["nombre" => "FY077"],
        ["nombre" => "BZC"],["nombre" => "TEMPESTAD"],["nombre" => "A BY T"],
        ["nombre" => "CADEX"],["nombre" => "TECIN"],["nombre" => "CONFIAR"],
        ["nombre" => "KIDDE"],["nombre" => "NORBCO"],["nombre" => "ECI"],
        ["nombre" => "FAMILSODA"],["nombre" => "SODA HOGAR"],["nombre" => "GEORGIA"],
        ["nombre" => "BERISO"],["nombre" => "RC"],["nombre" => "AQUALUNG"],
        ["nombre" => "INDEXCIL"],["nombre" => "MATA97"],["nombre" => "JP"],
        ["nombre" => "SAVAL"],["nombre" => "TJ"],["nombre" => "MOZART"],
        ["nombre" => "ACETILENE SRL"],["nombre" => "LGM"],["nombre" => "CATALINA"],
        ["nombre" => "IAPI"],["nombre" => "WK"],["nombre" => "CEA"],
        ["nombre" => "TW"],["nombre" => "CLIFFON"],["nombre" => "LA AUTOGENA"],
        ["nombre" => "DONNY"],["nombre" => "M47"],["nombre" => "MID"],
        ["nombre" => "LS"],["nombre" => "MV"],["nombre" => "PREVISOL"],["nombre" => "CL"]];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('marcas_cilindros')->insert($this->datos);
    }
}
