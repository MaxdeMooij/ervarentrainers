<?php

namespace Application\Migrations;

use AppBundle\Entity\Training;
use AppBundle\Entity\User;
use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Gedmo\Sluggable\Util\Urlizer;
use Sluggable\Fixture\Handler\ArticleRelativeSlug;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170704221652 extends AbstractMigration implements ContainerAwareInterface
{
    /** @var ContainerInterface */
    protected $container;

    /**
     * Sets the container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user ADD slug VARCHAR(255) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649989D9B62 ON user (slug)');
        $this->addSql('ALTER TABLE training ADD slug VARCHAR(255) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D5128A8F989D9B62 ON training (slug)');
    }

    /**
     * @param Schema $schema
     */
    public function postUp(Schema $schema)
    {

        // Get all trainings from the database, and update updatedAt to trigger slug generation
        $em = $this->container->get('doctrine.orm.entity_manager');
        $trainings = $em->getRepository(Training::class)->findAll();
        /** @var Training $training */
        foreach($trainings as $training) {
            $training->setUpdatedAt(new \DateTime());
            $training->setSlug(Urlizer::urlize($training->getTitle()));
            $em->persist($training);
        }
        $em->flush();
        $em->clear();

        // Same for users
        $users = $em->getRepository(User::class)->findAll();
        /** @var User $user */
        foreach($users as $user) {
            $user->setUpdatedAt(new \DateTime());
            $user->setSlug(strtolower(Urlizer::urlize($user->getFirstName().'-'.$user->getLastName())));
            $em->persist($user);
        }
        $em->flush();
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_D5128A8F989D9B62 ON training');
        $this->addSql('ALTER TABLE training DROP slug');
        $this->addSql('DROP INDEX UNIQ_8D93D649989D9B62 ON user');
        $this->addSql('ALTER TABLE user DROP slug');
    }
}
