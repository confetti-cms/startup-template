# typed: false
# frozen_string_literal: true

# This file was generated by GoReleaser. DO NOT EDIT.
class Confetti < Formula
  desc ""
  homepage "https://confetti-cms.com"
  version "0.4.15"

  on_macos do
    url "https://github.com/confetti-cms/client/releases/download/0.4.15/client_0.4.15_darwin_all.tar.gz"
    sha256 "34f3a943ddfd5d63285f50af113a6bfd25feb828f61bde2460e77699acaabcf6"

    def install
      binary: confetti
      bin.install "confetti"
    end
  end

  on_linux do
    if Hardware::CPU.arm? && Hardware::CPU.is_64_bit?
      url "https://github.com/confetti-cms/client/releases/download/0.4.15/client_0.4.15_linux_arm64.tar.gz"
      sha256 "c6055b9f505457bad170e9eabe8bc958c362860cdb9d17fd644c8ceac74f82fc"

      def install
        binary: confetti
        bin.install "confetti"
      end
    end
    if Hardware::CPU.intel?
      url "https://github.com/confetti-cms/client/releases/download/0.4.15/client_0.4.15_linux_amd64.tar.gz"
      sha256 "bbfb14c87c0961ae734f4b844df887662f2d04abd2a537f876a0504ff93f51f8"

      def install
        binary: confetti
        bin.install "confetti"
      end
    end
  end
end
