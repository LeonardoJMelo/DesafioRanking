<?php
namespace App\Repositories;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class RankingRepository extends RepositoryBase
{
    
    public function buscarRanking($nameMovement)
    {
        return DB::select(
            "
            SELECT 
                movement.name nameMovement,
                `user`.name nameUser,
                MAX(personal_record.value) value,
                personal_record.`date` 
            FROM personal_record 
                JOIN `user` ON personal_record.user_id = `user`.id 
                JOIN movement ON personal_record.movement_id = movement.id
            WHERE 
                movement.id = ".$nameMovement."
            GROUP BY
                `user`.id, 
                personal_record.value, 
                personal_record.`date`
            "
        );
    }
}