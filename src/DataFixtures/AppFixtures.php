<?php declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Album;
use App\Entity\Artist;
use App\Entity\Song;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $url = "https://gist.githubusercontent.com/fightbulc/9b8df4e22c2da963cf8ccf96422437fe/raw/8d61579f7d0b32ba128ffbf1481e03f4f6722e17/artist-albums.json";

        $data = \json_decode(\file_get_contents($url), true);

        foreach ($data as $artistData) {
            $artist = new Artist();
            $artist->setName($artistData['name']);
            $manager->persist($artist);

            foreach ($artistData['albums'] as $albumData) {
                $album = new Album();
                $album->setArtist($artist)
                    ->setTitle($albumData['title'])
                    ->setCover($albumData['cover'])
                    ->setDescription($albumData['description'])
                    ;
                $manager->persist($album);

                foreach ($albumData['songs'] as $songData) {
                    $song = new Song();
                    $song->setAlbum($album);
                    $song->setTitle($songData['title']);
                    $song->setLength($this->transformLengthToSeconds($songData['length']));

                    $manager->persist($song);
                }
            }
        }
        $manager->flush();
    }

    /**
     * @param string $lengths
     * @return int
     */
    private function transformLengthToSeconds(string $length): int
    {
        $partTime = array_reverse(explode(':', $length));

        $seconds = 0;

        for($i=0; $i<count($partTime); $i++ ){
            $seconds += (pow(60, $i))*$partTime[$i];
        }

        return $seconds;
    }
}