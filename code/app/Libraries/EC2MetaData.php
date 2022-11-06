<?php
/**
 * c
 * @author Ahmed Samir <ahmedsamir732@gmail.com>
 * @package EC2AvailabilityZone
 */
namespace App\Libraries;

use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;

/**
 * EC2MetaData renders ec2 metadata.
 * @author Ahmed Samir <ahmedsamir732@gmail.com>
 * Example:
 * $ ec2-metadata
 *   ami-id: ami-02663f749a66a3a8c
 *   ami-launch-index: 0
 *   ami-manifest-path: (unknown)
 *   ancestor-ami-ids: not available
 *   block-device-mapping:
 *           ami: xvda
 *           root: /dev/xvda
 *   instance-id: i-0bdab0e5b45f75695
 *   instance-type: c5.2xlarge
 *   local-hostname: ip-172-21-2-74.eu-west-1.compute.internal
 *   local-ipv4: 172.21.2.74
 *   kernel-id: not available
 *   placement: eu-west-1a
 *   product-codes: not available
 *   public-hostname: not available
 *   public-ipv4: not available
 *   public-keys:
 *   keyname:APP-Key
 *   index:0
 *   format:openssh-key
 *   key:(begins from next line)
 *   ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQCC6QEh3YkeeLRg89XX/YOKIuSR3SzoR8W9cAYLk7dAHzbFQQdf0aItVhu5Nq8BUR75qFWISex0DeFdntDOmoh2U2SZHtZW6E2Wmkbmqj8tkuJtPyT/JgpCEdJ8p+HnRF6J/3tTt2et2rKT7esD/RFZvmGdkq6gpE+PcEjRLr06xrU2lZYEdTW4tHopSU+uo3oagfjw6Vmt9PSs61qN2RAn/iCH6VKC+a6lAReTWutRmheADLgb6Boh+n2vJTJLhQGjf6myiZXUcdLHzYx+mJ50OI4XwnB8+NGsdVrPLPePFeIqz7IztvUEQT7yt4mlJkCcmAV5fUvqYpMzHI/x5X9N APP-Key
 *   ramdisk-id: not available
 *   reservation-id: r-08088c0409d91bb4e
 *   security-groups: ENG-BACK-SG
 *   user-data: not available
 */
class EC2MetaData
{
    public static function getInstanceID(): string
    {
        $instanceId = shell_exec('ec2-metadata --instance-id 2> /dev/null | cut -d " " -f 2');
        if (!$instanceId) {
            throw new NotAcceptableHttpException('could not extract instance id.');
        }

        return $instanceId;
    }

    public static function getAvailabilityZone(): string
    {
        $placement = shell_exec('ec2-metadata --placement 2> /dev/null | cut -d " " -f 2');
        if (!$placement) {
            throw new NotAcceptableHttpException('could not extract placement.');
        }
        return $placement;
    }
}