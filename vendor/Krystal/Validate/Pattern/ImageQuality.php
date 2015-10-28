<?php

/**
 * This file is part of the Krystal Framework
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Krystal\Validate\Pattern;

final class ImageQuality extends AbstractPattern
{
    /**
     * {@inheritDoc}
     */
    public function getDefinition()
    {
        return $this->getWithDefaults(array(
            'required' => true,
            'rules' => array(
                'NotEmpty' => array(
                    'message' => "Image's quality can not be empty"
                ),
                'Numeric' => array(
                    'message' => "Image's quality must be numeric",
                ),
                'Between' => array(
                    'message' => "Image's quality must be between 1 and 100",
                    'value' => array(1, 100)
                )
            )
        ));
    }
}
