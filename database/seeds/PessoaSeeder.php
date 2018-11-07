<?php

use Illuminate\Database\Seeder;
use App\Pessoa;
use Illuminate\Support\Facades\DB;

class PessoaSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        
        DB::table('tbpessoa')->delete();
        
        for($i = 1; $i < 11; $i++) {
            $aDados = $this->geraDadosPessoa();
            
            $oPessoa = new Pessoa();
            $oPessoa->setCodigo($i);
            $oPessoa->setNomeRazao($aDados['pesnomerazao']);
            $oPessoa->setCpfCnpj($aDados['pescpfcnpj']);
            $oPessoa->setRg($aDados['pesrg']);
            $oPessoa->setTipo($aDados['pestipo']);
            $oPessoa->setEmail($aDados['pesemail']);
            $oPessoa->save();
        }
    }
    
    private function geraDadosPessoa(){
        $sNome = $this->randomizaNomes();
        $sEmail = '';
        foreach(explode(' ', $sNome) as $xItem) {
            $sEmail .= $sEmail != '' ? '.' : '';
            $sEmail .= strtolower($xItem);
        }
        $sEmail .= '@gmail.com';
        $dados = [
            'pesnomerazao' => $sNome,
            'pescpfcnpj' => $this->randomizaCpfCnpj(),
            'pesrg' => $this->randomizaRg(),
            'pestipo' => 1,
            'pesemail' => $sEmail
        ];
        return $dados;
    }

    private function randomizaNomes() {
        $aNomes = [
            'Jacson', 'Claudio', 'William', 'Tiago', 'Rubens', 'Diego', 'Adriano', 'Lennon', 'João', 'Douglas',
            'Roberto', 'Daniel', 'Pedro', 'Lucas'
        ];

        $aSobrenomes = [
            'Silva', 'Sasse', 'Ferrari', 'Pogalski', 'Arnt', 'Franz', 'Oliveira', 'Patrocinio', 'Deitos',
            'Zambam'
        ];

        $randNome = rand(0, count($aNomes)-1 );
        $randSobre = rand(0, count($aSobrenomes)-1);
        return $aNomes[$randNome] . ' ' . $aSobrenomes[$randSobre];
    }

    private function randomizaCpfCnpj() {
        $bIsCpf = 1;//random_int(0, 1);
        $sNumero = '';
        if ($bIsCpf) {
            for ($i = 0; $i < 11; $i++) {
                $sNumero .= random_int(1, 9);
            }
            return $this->aplicaMascara($sNumero, '000.000.000-00');
        } else {
            for ($i = 0; $i < 14; $i++) {
                $sNumero .= random_int(1, 9);
            }
            return $this->aplicaMascara($sNumero, '00.000.000/0000-00');
        }
    }
    
    private function randomizaRg(){
        $sNumero = '';
        for ($i = 0; $i < 9; $i++) {
            $sNumero .= random_int(1, 9);
        }
        return $this->aplicaMascara($sNumero, '00.000.000-0');
    }

    private function aplicaMascara($val, $mask) {
        $maskared = '';
        $k = 0;
        for ($i = 0; $i < strlen($mask); $i++) {
            if ($mask[$i] == '0') {
                if (isset($val[$k]))
                    $maskared .= $val[$k++];
            }
            else {
                if (isset($mask[$i]))
                    $maskared .= $mask[$i];
            }
        }
        return $maskared;
    }

}
