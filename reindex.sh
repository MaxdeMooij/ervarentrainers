#!/usr/bin/env bash
bin/console algolia:reindex '\AppBundle\Entity\User'
bin/console algolia:reindex '\AppBundle\Entity\Training'