<?php declare(strict_types=1);

namespace App\Command;

use OTPHP\TOTP;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Command to generate the TOTP secret.
 *
 * @since 2024.02.27
 */
#[AsCommand(name: 'totp:generate-secret')]
class TotpGenerateSecretCommand extends Command
{
    /**
     */
    #[\Override]
    protected function configure(): void
    {
        $this->setDescription('Generate a TOTP secret.');
    }

    /**
     */
    #[\Override]
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $config_file = __DIR__.'/../../.env.local';
        if (!file_exists($config_file)) {
            $output->writeln('The configuration file .env.local does not exist.');

            return Command::FAILURE;
        }

        $content = file_get_contents($config_file);
        preg_match('/TOTP_SECRET=(.*)?/', $content, $match);
        if ($match && $match[1]) {
            $output->writeln('The secret was already generated, please remove it yourself to generate a '.
                'new one.');

            return Command::FAILURE;
        }

        $otp = TOTP::generate();
        if ($match) {
            $content = str_replace('TOTP_SECRET=', 'TOTP_SECRET='.$otp->getSecret(), $content);
        } else {
            $content .= "\nTOTP_SECRET=".$otp->getSecret()."\n";
        }
        file_put_contents($config_file, $content);

        $output->writeln('Code generated, view with totp:qr-code.');

        return Command::SUCCESS;
    }
}
