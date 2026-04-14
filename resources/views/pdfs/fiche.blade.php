<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Fiche de commande</title>
    <style>
        body { 
            font-family: DejaVu Sans, sans-serif; 
            font-size: 12px; 
        }
        table { 
            border-collapse: collapse; 
            width: 100%; 
        }
        td, th { 
            border: 1px solid #000; 
            padding: 6px; 
            vertical-align: top;
        }
        .no-border { border: none !important; }
        .center { text-align: center; }
        .title { 
            font-size: 18px; 
            font-weight: bold; 
            text-align: center; 
            border: 1px solid #000;
            padding: 6px;
        }
        .section-title {
            font-weight: bold;
            text-decoration: underline;
            text-align: center;
            margin: 10px 0;
        }
        .signature td {
            height: 60px;
        }
    </style>
</head>
<body>
    <div class="container" style="border: #000 2px solid; ">

        <table>
            <tr>
                <td rowspan="2" class="center no-border" style="width:20%;">
                    <img src="logo.png" alt="Logo" style="max-height:50px;"><br>
                </td>
                <td class="title" colspan="2">FICHE DE COMMANDE</td>
            </tr>
            <tr>
                <td><b>DATE :</b> {{ $fiche['dateCommande'] }}</td>
                
                <td><b>N° DE FICHE :</b> {{ $fiche['numFiche'] }}</td>
            </tr>
        </table>
        <!-- EMETTEUR / DEMANDEUR -->
        <table>
            <tr>
                <th colspan="2" class="center">EMETTEUR</th>
                <th colspan="2" class="center">DEMANDEUR</th>
            </tr>
            <tr>
                <td><b>CHEF ATELIER :</b></td>
                <td></td>
                <td><b>NOM :</b> {{ $fiche['nomDemandeur'] }}</td>
                <td><b>CHANTIER :</b> {{ $fiche['chantier'] }}</td>
            </tr>
            <tr>
                <td><b>DATE DE DEBUT DE FABRICATION :</b></td>
                <td></td>
                <td><b>DATE DE LIVRAISON :</b></td>
                <td></td>
            </tr>
            <tr>
                <td><b>DATE DE FIN DE FABRICATION :</b></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
    
        <!-- CHANTIER / ZONE / TRANCHE / AUTRES -->
        <table>
            <tr>
                <th class="center">Chantier</th>
                <th class="center">Zone</th>
                <th class="center">Tranche</th>
                <th class="center">Autres</th>
            </tr>
            <tr>
                <td class="center">{{ $fiche['chantier'] }}</td>
                <td class="center"></td>
                <td class="center">----</td>
                <td class="center">----</td>
            </tr>
        </table>
    
        <!-- PRODUIT -->
        <div class="section-title">Produit</div>
    
        <table>
            <tr>
                <th class="center">ARTICLE DEMANDE</th>
                <th class="center">QTE</th>
            </tr>
            <tr>
                <td>{{ $fiche['articleDemande'] }}</td>
                <td class="center">{{ $fiche['quantite'] }}</td>
            </tr>
            <tr>
                <td colspan="2"><b>DESCRIPTION :</b> {{ $fiche['description'] }}</td>
            </tr>
        </table>
    
        <!-- SIGNATURES -->
        <table>
            <tr>
                <td class="center"><b>CONTROLE DE GESTION</b></td>
                <td class="center"><b>CHEF D'ATELIER</b></td>
                <td class="center"><b>DEMANDEUR</b></td>
            </tr>
            <tr class="signature">
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </div>

</body>
</html>