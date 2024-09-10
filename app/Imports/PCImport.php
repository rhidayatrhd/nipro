<?php

namespace App\Imports;

use App\Models\DataPC;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;

class PCImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        // \dd($collection);
        $indx = 1;
        foreach($collection as $row) {
            if($indx > 1) {
                $count = DataPC::where('pchost', $row[1])->count();
                // \dd($count, $row[1]);
                if ($count > 0) {} else {
                // \dd($row[2]);
                $data['pchost'] = !empty($row[1]) ? $row[1] : '';                
                $data['asset_id'] = !empty($row[2]) ? $row[2] : '';                
                $data['pctype'] = !empty($row[3]) ? $row[3] : '';
                $data['brand'] = !empty($row[4]) ? $row[4] : '';
                $data['model'] = !empty($row[5]) ? $row[5] : '';
                $data['processor'] = !empty($row[6]) ? $row[6] : '';
                $data['ipadrs'] = !empty($row[7]) ? $row[7] : '';
                $data['ram'] = !empty($row[8]) ? $row[8] : '';
                $data['hdd'] = !empty($row[9]) ? $row[9] : '';
                $data['purchyear'] = !empty($row[10]) ? $row[10] : '';
                $data['username'] = !empty($row[11]) ? $row[11] : '';
                $data['userlevel'] = !empty($row[12]) ? $row[12] : '';
                $data['userdept'] = !empty($row[13]) ? $row[13] : '';
                $data['useremail'] = !empty($row[14]) ? $row[14] : '';
                $data['osystem'] = !empty($row[15]) ? $row[15] : '';
                $data['spreadsheet'] = !empty($row[16]) ? $row[16] : '';
                $data['usedfor'] = !empty($row[17]) ? $row[17] : '';
                $data['antivirus'] = !empty($row[18]) ? $row[18] : '';
                $data['cost_ctr'] = !empty($row[19]) ? $row[19] : '';
                // \dd($data);

                DataPC::create($data);
                }
            }
            $indx++;
        }
    }
}
