<?php

namespace pocketmine\network\protocol;

#include <rules/DataPacket.h>



class PlayerListPacket extends DataPacket
{
    const NETWORK_ID = Info::PLAYER_LIST_PACKET;

    const TYPE_ADD = 0;
    const TYPE_REMOVE = 1;

    //REMOVE: UUID; ADD: UUID, entity id, name, skinID, skin
    /** @var array[] */
    public $entries = [];
    public $type;

    public function clean()
    {
        $this->entries = [];
        return parent::clean();
    }

    public function decode()
    {
    }

    public function encode()
    {
        $this->reset();
        $this->putByte($this->type);
        $this->putInt(count($this->entries));
        foreach ($this->entries as $entry) {
            if ($this->type === self::TYPE_ADD) {
                $this->putUUID($entry[0]);
                $this->putLong($entry[1]);
                $this->putString($entry[2]);
                $this->putString($entry[3]);
                $this->putString($entry[4]);
            } else {
                $this->putUUID($entry[0]);
            }
        }
    }
}
