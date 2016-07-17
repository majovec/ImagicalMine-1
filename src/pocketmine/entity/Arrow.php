<?php
/**
 * src/pocketmine/entity/Arrow.php
 *
 * @package default
 */




namespace pocketmine\entity;

use pocketmine\level\format\FullChunk;
use pocketmine\level\particle\CriticalParticle;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\network\protocol\AddEntityPacket;
use pocketmine\Player;

class Arrow extends Projectile
{
    const NETWORK_ID = 80;

    public $width = 0.5;
    public $length = 0.5;
    public $height = 0.5;

    protected $gravity = 0.05;
    protected $drag = 0.01;

    protected $damage = 2;

    protected $isCritical;

    /**
     *
     * @param FullChunk   $chunk
     * @param CompoundTag $nbt
     * @param Entity      $shootingEntity (optional)
     * @param unknown     $critical       (optional)
     */
    public function __construct(FullChunk $chunk, CompoundTag $nbt, Entity $shootingEntity = null, $critical = false)
    {
        $this->isCritical = (bool) $critical;
        parent::__construct($chunk, $nbt, $shootingEntity);
    }


    /**
     *
     * @param unknown $currentTick
     * @return unknown
     */
    public function onUpdate($currentTick)
    {
        if ($this->closed) {
            return false;
        }

        $this->timings->startTiming();

        $hasUpdate = parent::onUpdate($currentTick);

        if (!$this->hadCollision and $this->isCritical) {
            $this->level->addParticle(new CriticalParticle($this->add(
                        $this->width / 2 + mt_rand(-100, 100) / 500,
                        $this->height / 2 + mt_rand(-100, 100) / 500,
                        $this->width / 2 + mt_rand(-100, 100) / 500)));
        } elseif ($this->onGround) {
            $this->isCritical = false;
        }

        if ($this->age > 1200) {
            $this->kill();
            $hasUpdate = true;
        }

        $this->timings->stopTiming();

        return $hasUpdate;
    }


    /**
     *
     * @param Player  $player
     */
    public function spawnTo(Player $player)
    {
        $pk = new AddEntityPacket();
        $pk->type = Arrow::NETWORK_ID;
        $pk->eid = $this->getId();
        $pk->x = $this->x;
        $pk->y = $this->y;
        $pk->z = $this->z;
        $pk->speedX = $this->motionX;
        $pk->speedY = $this->motionY;
        $pk->speedZ = $this->motionZ;
        $pk->metadata = $this->dataProperties;
        $player->dataPacket($pk);

        parent::spawnTo($player);
    }
}
